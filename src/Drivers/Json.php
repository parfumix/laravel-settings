<?php

namespace Laravel\Settings\Drivers;

use Laravel\Settings\Driver;
use Laravel\Settings\DriverAble;

class Json extends Driver implements DriverAble {

    /**
     * Set sdk .
     *
     * @return mixed
     */
    public function init() {
        // TODO: Implement init() method.
    }

    /**
     * Retrieve all options/values.
     *
     * @return array
     */
    public function all() {
        // TODO: Implement all() method.
    }

    /**
     * Retrieve option .
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null) {
        // TODO: Implement get() method.
    }

    /**
     * update option value.
     *
     * @return void
     */
    public function update($key, $value) {
        // TODO: Implement update() method.
    }

    /**
     * Insert a new option and set value.
     *
     * @return void
     */
    public function inert($key, $value) {
        // TODO: Implement inert() method.
    }

    /**
     * delete option.
     *
     * @return void
     */
    public function delete($key) {
        // TODO: Implement delete() method.
    }

    /**
     * delete all options entries from .
     *
     * @return array
     */
    public function clear() {
        // TODO: Implement clear() method.
    }

}