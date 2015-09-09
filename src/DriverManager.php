<?php

namespace Laravel\Settings;

use Flysap\Support\DriverManager as AbstractDriverManager;

class DriverManager extends AbstractDriverManager {

    /**
     * @var
     */
    protected $configuration;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration) {
        $this->configuration = $configuration;

        $this->setDrivers(
            $configuration['drivers']
        );
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    protected function getDefaultDriver() {
        return $this->configuration['default'];
    }

}