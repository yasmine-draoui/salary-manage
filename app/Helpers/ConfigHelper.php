<?php

namespace App\Helpers;
use App\Models\configuration;

class ConfigHelper{
    public static function getAppName(){
        $appName = Configuration::where('type','APP_NAME')->value('value');

        return $appName;
    }
}
?>
