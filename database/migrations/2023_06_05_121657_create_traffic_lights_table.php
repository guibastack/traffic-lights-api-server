<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('traffic_lights', function(Blueprint $table) {

            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->timestamps();
            $table->string('latitude');
            $table->string('longitude');

        });

    }

    public function down(): void {

        if (Schema::hasTable('traffic_lights')) {

            Schema::drop('traffic_lights');

        }

    }

};
