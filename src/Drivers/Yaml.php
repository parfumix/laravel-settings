<?php

namespace Laravel\Settings\Drivers;

use Laravel\Settings\DriverAble;
use Flysap\Support;
use Laravel\Settings\FileDriver;
use Symfony\Component\Yaml\Yaml as YamlParser;

class Yaml extends FileDriver implements DriverAble {

    /**
     * Pack data before save .
     *
     * @param $data
     * @return string
     */
    public function packData($data) {
        return YamlParser::dump($data);
    }
}