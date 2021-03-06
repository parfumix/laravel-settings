<?php

namespace Laravel\Settings;

use Flysap\Support\Traits\AttributesTrait;

abstract class Driver {

    use AttributesTrait;

    const DEFAULT_GROUP = 'general';

    public function __construct(array $options = array()) {
        $this->setAttributes($options);

        $this->init();
    }

    /**
     * Set sdk .
     *
     * @return mixed
     */
    abstract public function init();
}