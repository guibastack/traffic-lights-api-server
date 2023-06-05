<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('traffic_lights', 'id') && Schema::hasTable('traffic_lights_history')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->bigInteger('traffic_light')->unsigned();

            });

            if (Schema::hasColumn('traffic_lights_history', 'traffic_light')) {

                Schema::table('traffic_lights_history', function(Blueprint $table) {

                    $table->foreign('traffic_light')->references('id')->on('traffic_lights');

                });

            }

        }

    }

    public function down(): void {

        if (Schema::hasColumn('traffic_lights_history', 'traffic_light')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->dropConstrainedForeignId('traffic_light');

            });

        }

    }

};
