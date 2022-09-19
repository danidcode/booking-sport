<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('imageInStorage')) {
    function imageInStorage($data, $default = null)
    {
        $image_64 = $data;

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(10) . '.' . $extension;

        Storage::disk('public')->put($imageName, base64_decode($image));

        return "/storage/" . $imageName;
    }
}
