<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Schema\Blueprint as Blueprint;
use Illuminate\Database\Migrations\Migration as Migration;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('traffic_lights_history', 'red_light_start')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->datetime('red_light_start')->change();

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'red_light_end')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {
                
                $table->dropColumn('red_light_end');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'yellow_light_start')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->dropColumn('yellow_light_start');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'yellow_light_end')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->dropColumn('yellow_light_end');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'green_light_start')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->dropColumn('green_light_start');

            });

        }

        if (Schema::hasColumn('traffic_lights_history', 'green_light_end')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->dropColumn('green_light_end');

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('traffic_lights_history', 'red_light_start')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->timestamp('red_light_start')->change();

            });

        }

        if (!Schema::hasColumn('traffic_lights_history', 'red_light_end')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->timestamp('red_light_end');

            });

        }

        if (!Schema::hasColumn('traffic_lights_history', 'yellow_light_start')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->timestamp('yellow_light_start');

            });

        }

        if (!Schema::hasColumn('traffic_lights_history', 'yellow_light_end')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->timestamp('yellow_light_end');

            });

        }

        if (!Schema::hasColumn('traffic_lights_history', 'green_light_start')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->timestamp('green_light_start');

            });

        }

        if (!Schema::hasColumn('traffic_lights_history', 'green_light_end')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->timestamp('green_light_end');

            });

        }

    }

};
