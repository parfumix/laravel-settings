<?php

namespace Laravel\Settings;

use Illuminate\Support\Facades\Facade;

class Settings extends Facade {

    public static function getFacadeAccessor() {
        return 'settings-manager';
    }
}