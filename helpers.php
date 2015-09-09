<?php

namespace Laravel\Settings;

/**
 * Get settings by key ..
 *
 * @param $key
 * @param null $default
 * @return mixed
 */
function get($key, $default = null) {
    return app('settings-manager')
        ->get($key, $default);
}