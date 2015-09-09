<?php

namespace Laravel\Settings\DriverAssets\Database;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

    public $table = 'settings';

    public $fillable = ['group', 'key', 'value'];
}
