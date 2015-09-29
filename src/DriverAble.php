<?php

namespace Laravel\Settings;


interface DriverAble {

    /**
     * Retrieve all options/values.
     *
     * @param null $group
     * @return array
     */
    public function all($group = null);

    /**
     * Retrieve option .
     *
     * @param $key
     * @param null $group
     * @param null $default
     * @return mixed
     */
    public function get($key, $group = null, $default = null);

    /**
     * update option value.
     *
     * @param $key
     * @param $value
     * @param null $group
     */
    public function update($key, $value, $group = null);

    /**
     * Insert a new option and set value.
     *
     * @param $key
     * @param $value
     * @param null $group
     */
    public function insert($key, $value, $group = null);

    /**
     * delete option.
     *
     * @param $key
     * @param null $group
     */
    public function delete($key, $group = null);

    /**
     * delete all options entries from .
     *
     * @return array
     */
    public function clear();
}