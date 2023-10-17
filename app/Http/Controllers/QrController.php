<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QrCode;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index()
    {
        $qr_codes = QrCode::latest();
        if ($category_id = request('c')) {
            $qr_codes->where('category_id', $category_id);
        }
        if ($search = request('q')) {
            $qr_codes->where(function ($query) use($search) {
                $query->orWhere('title','LIKE',"%{$search}%")
                    ->orWhere('description','LIKE',"%{$search}%")
                    ->orWhere('floor','LIKE',"%{$search}%");
            });
        }
        $qr_codes = $qr_codes->with('category')->paginate(15);

        return view('qr-codes.index', [
            'qr_codes' => $qr_codes,
            'categories' => Category::all()
        ]);
    }
    public function prints()
    {
        return view('qr-codes.prints', [
            'floors' => QrCode::all()->pluck('floor'),
            'categories' => Category::all()
        ]);
    }
    public function filteredPrint(Request $request)
    {
        $qrcodes = QrCode::latest();

        if ($request->has('title')) {
            $search = $request->title;
            $qrcodes->where(function ($query) use($search) {
                $query->orWhere('title','LIKE',"%{$search}%")
                    ->orWhere('description','LIKE',"%{$search}%");
            });
        }

        if ($request->has('floors')) {
            $qrcodes->whereIn('floor', $request->floors);
        }

        if ($request->has('categories')) {
            $qrcodes->whereIn('category_id', $request->categories);
        }

        return view('qr-codes.prints-filter', [
            'category_info' => intval($request->text_category ?? 1),
            'title_info' => intval($request->text_title ?? 1),
            'desc_info' => intval($request->text_desc ?? 0),
            'floor_info' => intval($request->text_floor ?? 0),
            'size' => intval($request->size ?? 50),
            'qrcodes' => $qrcodes->get()
        ]);
    }
    public function print(QrCode $qrcode)
    {
        return view('qr-codes.print', [
            'qrcode' => $qrcode
        ]);
    }
    public function add()
    {
        return view('qr-codes.add', [
            'categories' => Category::all()
        ]);
    }
    public function store(Request $request)
    {
        if (empty($request->title)) {
            return response()->json([
                'message' => 'QR kodu başlığı zorunludur!'
            ], 400);
        } elseif (empty($request->description)) {
            return response()->json([
                'message' => 'QR kodu içeriği zorunludur!'
            ], 400);
        } elseif (empty($request->category_id)) {
            return response()->json([
                'message' => 'Kategori Adı zorunludur!'
            ], 400);
        }

        $filename = Str::random(16);

        $qr_code = new QrCode();
        $qr_code->category_id = $request->category_id;
        $qr_code->qr_code = $filename . '.png';
        $qr_code->title = $request->title;
        $qr_code->description = $request->description;
        $qr_code->floor = $request->floor ?? 'Yok';
        $qr_code->save();

        try {
            QrCodeGenerator::encoding('UTF-8')
                ->size(250)
                ->margin(1)
                ->style('square')
                ->eye('square')
                ->format('png')
                ->generate(
                    sprintf('%s, %s, %s', $qr_code->category->name, $qr_code->title, $qr_code->description),
                    public_path('qrcodes/' . $qr_code->id . '-' . $filename . '.png')
                );
        } catch (\Exception $e) {
            $qr_code->delete();
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }

        $qr_code->qr_code = $qr_code->id . '-' . $filename . '.png';
        $qr_code->save();

        return response()->json([
            'message' => 'QR Kod başarıyla eklendi!'
        ]);
    }
    public function delete(QrCode $qrcode)
    {
        $qrcode->delete();

        return response()->json([
            'message' => 'QR kod başarıyla silindi, içeriği silinemez!'
        ]);
    }
}
