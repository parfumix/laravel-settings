<?php

namespace Laravel\Settings\Drivers;

use Laravel\Settings\Driver;
use Laravel\Settings\DriverAble;
use Laravel\Settings\DriverAssets\Database\Setting;
use Laravel\Settings\DriverAssets\Database\SettingsRepository;

class Database extends Driver implements DriverAble {

    /**
     * @var
     */
    protected $repository;

    /**
     * Set sdk .
     *
     * @return mixed
     */
    public function init() {
        $this->repository = new SettingsRepository(
            new Setting
        );
    }

    /**
     * Retrieve all options/values.
     *
     * @param null $group
     * @return array
     */
    public function all($group = null) {
        return $this->repository
            ->all()
            ->toArray();
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
        $settings = $this->repository
            ->getByKey($key, $group);

        return isset($settings) ? $settings->value : $default;
    }

    /**
     * update option value.
     *
     * @param $key
     * @param $value
     * @param null $group
     * @return bool|void
     */
    public function update($key, $value, $group = null) {
        $this->repository->updateOrCreate($key, [
            'value' => $value,
            'group' => $group
        ]);

        return true;
    }

    /**
     * Insert a new option and set value.
     *
     * @param $key
     * @param $value
     * @param null $group
     * @return bool|void
     */
    public function insert($key, $value, $group = null) {
        $this->repository->updateOrCreate($key, [
            'value' => $value,
            'group' => $group
        ]);

        return true;
    }

    /**
     * delete option.
     *
     * @param $key
     * @param null $group
     * @return bool|void
     */
    public function delete($key, $group = null) {
        $this->repository
            ->deleteByKey($key, $group);

        return true;
    }

    /**
     * delete all options entries from .
     *
     * @return array
     */
    public function clear() {
        $this->repository
            ->deleteAll();

        return true;
    }

}