<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_setting_image')) {
    function get_setting_image($key, $defaultPath)
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting && $setting->value && Storage::disk('public')->exists($setting->value)) {
            return Storage::url($setting->value);
        }

        // Jika setting tidak ada, gunakan gambar default dari folder public/assets
        return asset($defaultPath);
    }
}
