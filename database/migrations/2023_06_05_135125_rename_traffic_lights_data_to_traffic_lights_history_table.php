<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasTable('traffic_lights_data')) {

            Schema::rename('traffic_lights_data', 'traffic_lights_history');

        }

    }

    public function down(): void {

        if (Schema::hasTable('traffic_lights_history')) {

            Schema::rename('traffic_lights_history', 'traffic_lights_data');

        }

    }

};
