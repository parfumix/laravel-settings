<?php

namespace Laravel\Settings;


interface DriverAble {

    /**
     * Retrieve all options/values.
     *
     * @return array
     */
    public function all();

    /**
     * Retrieve option .
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * update option value.
     *
     * @return void
     */
    public function update($key, $value);

    /**
     * Insert a new option and set value.
     *
     * @return void
     */
    public function inert($key, $value);

    /**
     * delete option.
     *
     * @return void
     */
    public function delete($key);

    /**
     * delete all options entries from .
     *
     * @return array
     */
    public function clear();
}