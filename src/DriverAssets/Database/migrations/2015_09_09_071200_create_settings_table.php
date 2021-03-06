<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group')->nullable()->default(null);
            $table->string('key');
            $table->string('value');

            $table->unique(['key', 'group']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('settings');
    }
}
