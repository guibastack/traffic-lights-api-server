<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('traffic_lights_data', function(Blueprint $table) {

            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->timestamps();
            $table->timestamp('red_light_start');
            $table->integer('red_light_duration');
            $table->timestamp('red_light_end');
            $table->timestamp('yellow_light_start');
            $table->integer('yellow_light_duration');
            $table->timestamp('yellow_light_end');
            $table->timestamp('green_light_start');
            $table->integer('green_light_duration');
            $table->timestamp('green_light_end');

        });

    }

    public function down(): void {

        if (Schema::hasTable('traffic_lights_data')) {

            Schema::drop('traffic_lights_data');

        }

    }

};
