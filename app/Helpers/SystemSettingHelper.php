<?php

use App\Models\Configuration;

if (!function_exists('get_system_config')) {
    function get_system_config($key, $default = null)
    {
        $config = Configuration::where('config_key', $key)->first();
        return $config ? $config->value : $default;
    }
}
