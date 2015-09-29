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
     * @param null $group
     * @return array
     */
    public function all($group = null) {
        if(! is_null($group))
            return isset($this->settings[$group]) ? $this->settings[$group] : [];

        return $this->settings;
    }

    /**
     * Retrieve option .
     *
     * @param string $key
     * @param null $group
     * @param null $default
     * @return mixed
     */
    public function get($key, $group = null, $default = null) {
        if(! is_null($group))
            return isset($this->settings[$group][$key]) ? $this->settings[$group][$key] : $default;

        return isset($this->settings[$key]) ? $this->settings[$key] : $default;
    }

    /**
     * update option value.
     *
     * @param $key
     * @param $value
     * @param null $group
     * @return $this|void
     */
    public function update($key, $value, $group = null) {
        if(! is_null($group))
            $this->settings[$group][$key] = $value;
        else
            $this->settings[$key] = $value;

        return $this;
    }

    /**
     * Insert a new option and set value.
     *
     * @param $key
     * @param $value
     * @param null $group
     * @return $this|Json|void
     */
    public function insert($key, $value, $group = null) {
        return $this->update($key, $value, $group);
    }

    /**
     * delete option.
     *
     * @param $key
     * @param null $group
     * @return $this|void
     */
    public function delete($key, $group = null) {
        if(! is_null($group)) {
            if( isset($this->settings[$group]) )
                unset($this->settings[$group]);
        } else {
            if( isset($this->settings[$key]) )
                unset($this->settings[$key]);
        }

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