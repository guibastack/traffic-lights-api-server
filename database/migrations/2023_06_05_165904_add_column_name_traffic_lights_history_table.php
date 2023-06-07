<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasTable('traffic_lights_history')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->string('name');

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('traffic_lights_history', 'name')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->dropColumn('name');

            });

        }

    }

};
