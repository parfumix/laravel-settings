<?php

namespace Laravel\Settings;

use Flysap\Support;

/**
 * Class FileDriver
 * @package Laravel\Settings
 *
 * we need to determine business logic for each of C.R.U.D operations
 *
 * 1. ->all will return all the settings loaded, if is passed $group param than it have return all settings from current group .
 * 2. ->get will return settings by key, if is passed $group as param than we have to send the settings from current group
 * 3. ->update setting by key. if there is no key than insert one, if is passed group than we have to update from current group
 * 4. ->insert will insert new key, if passed group than save for current group .
 * 5. ->delete will delete setting by key, if there is passed group than delete from current group .
 */

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