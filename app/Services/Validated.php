<?php

namespace App\Services;

class Validated
{
    public static function getUser(array $data)
    {
        $attributes = collect($data)->only('name', 'email')->toArray();

        $data['password'] != null
            ? $attributes['password'] = Hash::make($data['password']) : '';

        return $attributes;
    }
}