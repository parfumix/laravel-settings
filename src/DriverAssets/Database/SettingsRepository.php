<?php

namespace Laravel\Settings\DriverAssets\Database;

class SettingsRepository {

    protected $model;

    public function __construct(Setting $model) {
        $this->model = $model;
    }

    /**
     * Get all settings .
     *
     * @return mixed
     */
    public function all() {
        return $this->model->lists('value', 'key');
    }

    /**
     * Get by key .
     *
     * @param $key
     * @return mixed
     */
    public function getByKey($key) {
        return $this->model
            ->where('key', $key);
    }

    /**
     * Get by group .
     *
     * @param $group
     * @return mixed
     */
    public function getByGroup($group) {
        return $this->model
            ->where('group', $group)
            ->get();
    }

    /**
     * Delete setting by key .
     *
     * @param $key
     * @return $this
     */
    public function deleteByKey($key) {
        $setting = $this->model
            ->where('key', $key)
            ->first();

        if( isset($setting->id) )
            $setting->delete();

        return $this;
    }

    /**
     * Delete all settings .
     *
     * @return $this
     */
    public function deleteAll() {
        $this->model->truncate();

        return $this;
    }

    /**
     * Update or create .
     *
     * @param $key
     * @param array $data
     * @return $this
     */
    public function updateOrCreate($key, array $data) {
        $this->model->updateOrCreate([
            'key' => $key
        ], $data);

        return $this;
    }

}
