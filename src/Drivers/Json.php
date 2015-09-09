<?php

namespace Laravel\Settings\Drivers;

use Laravel\Settings\DriverAble;
use Laravel\Settings\FileDriver;

class Json extends FileDriver implements DriverAble {

    /**
     * Pack data before save .
     *
     * @param $data
     * @return string
     */
    public function packData($data) {
        return json_encode($data);
    }
}