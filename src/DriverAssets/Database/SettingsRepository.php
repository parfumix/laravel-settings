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
     * @param null $group
     * @return mixed
     */
    public function all($group = null) {
        if(! is_null($group))
            return $this->model->where('group', $group)->lists('value', 'key');

        return $this->model->lists('value', 'key');
    }

    /**
     * Get by key .
     *
     * @param $key
     * @param null $group
     * @return mixed
     */
    public function getByKey($key, $group = null) {
        $query =  $this->model
            ->where('key', $key);

        if(! is_null($group))
            $query->where('group', $group);

        return $query->get();
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
     * @param null $group
     * @return $this
     */
    public function deleteByKey($key, $group = null) {
        $query = $this->model
            ->where('key', $key);

        if(! is_null($group))
            $query->where('group', $group);

        $setting = $query
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
