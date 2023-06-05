<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('traffic_lights_history', 'red_light_duration')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->renameColumn('red_light_duration', 'red_light_duration_in_seconds');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'yellow_light_duration')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->renameColumn('yellow_light_duration', 'yellow_light_duration_in_seconds');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'green_light_duration')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->renameColumn('green_light_duration', 'green_light_duration_in_seconds');

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('traffic_lights_history', 'red_light_duration_in_seconds')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->renameColumn('red_light_duration_in_seconds', 'red_light_duration');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'yellow_light_duration_in_seconds')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->renameColumn('yellow_light_duration_in_seconds', 'yellow_light_duration');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'green_light_duration_in_seconds')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->renameColumn('green_light_duration_in_seconds', 'green_light_duration');

            });

        }

    }

};
