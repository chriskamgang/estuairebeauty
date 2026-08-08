<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

if (!function_exists('setting')) {
    /**
     * Retrieve a setting value from the settings table with caching.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            try {
                if (!Schema::hasTable('settings')) {
                    return $default;
                }
                $setting = DB::table('settings')->where('key', $key)->first();
                return $setting ? $setting->value : $default;
            } catch (\Exception $e) {
                return $default;
            }
        });
    }
}
