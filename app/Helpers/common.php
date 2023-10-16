<?php

if (!function_exists('cases')) {

    /**
     * @param string $enum
     * @return array
     */
    function cases(string $enum): array
    {
        return match ($enum) {
            'status' => \App\Enums\StatusEnum::cases(),
            'role'   => \App\Enums\RoleCodeEnum::cases(),
            'locale' => \App\Enums\LocaleEnum::cases(),
            'gender' => \App\Enums\GenderEnum::cases(),
            'postType' => \App\Enums\PostTypeEnum::cases(),
            default => []
        };
    }
}

