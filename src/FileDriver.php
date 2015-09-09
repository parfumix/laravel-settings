<?php

namespace Laravel\Settings;

use Flysap\Support;

abstract class FileDriver extends Driver {

    /**
     * @var array
     */
    protected $settings = [];

    /**
     * Pack data .
     *
     * @param $data
     * @return mixed
     */
    abstract function packData($data);

    /**
     * Set settings .
     *
     * @return mixed
     */
    public function init() {
        $attributes = $this->getAttributes();
        $fullPath = storage_path(
            $attributes['path']
        );

        if( Support\is_path_exists(
            $fullPath
        ) )
            $this->settings = Support\get_file_contents(
                $fullPath
            );
        else
            Support\dump_file($fullPath, json_encode([]));

        register_shutdown_function(function() use($fullPath) {
            Support\dump_file(
                $fullPath, $this->packData($this->settings)
            );
        });
    }

    /**
     * Retrieve all options/values.
     *
     * @return array
     */
    public function all() {
        return $this->settings;
    }

    /**
     * Retrieve option .
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null) {
        return isset($this->settings[$key]) ? $this->settings[$key] : $default;
    }

    /**
     * update option value.
     *
     * @param $key
     * @param $value
     * @return $this|void
     */
    public function update($key, $value) {
        $this->settings[$key] = $value;

        return $this;
    }

    /**
     * Insert a new option and set value.
     *
     * @param $key
     * @param $value
     * @return $this|Json|void
     */
    public function insert($key, $value) {
        return $this->update($key, $value);
    }

    /**
     * delete option.
     *
     * @param $key
     * @return $this|void
     */
    public function delete($key) {
        if( isset($this->settings[$key]) )
            unset($this->settings[$key]);

        return $this;
    }

    /**
     * delete all options entries from .
     *
     * @return array
     */
    public function clear() {
        $this->settings = [];

        return $this;
    }
}