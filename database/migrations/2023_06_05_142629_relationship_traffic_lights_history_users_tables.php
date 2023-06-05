<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('users', 'id') && Schema::hasTable('traffic_lights_history')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->bigInteger('user')->unsigned();

            });

            if (Schema::hasColumn('traffic_lights_history', 'user')) {

                Schema::table('traffic_lights_history', function(Blueprint $table) {

                    $table->foreign('user')->references('id')->on('users');

                });

            }

        }

    }

    public function down(): void {

        if (Schema::hasColumn('traffic_lights_history', 'user')) {

            Schema::table('traffic_lights_history', function(Blueprint $table) {

                $table->dropConstrainedForeignId('user');

            });

        }

    }

};
