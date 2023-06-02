<?php

use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('users', 'id') && Schema::hasTable('profiles')) {

            Schema::table('profiles', function(Blueprint $table) {

                $table->bigInteger('user')->unsigned();

            });

            if (Schema::hasColumn('profiles', 'user')) {

                Schema::table('profiles', function(Blueprint $table) {

                    $table->foreign('user')->references('id')->on('users');

                });

            }

        }

    }

    public function down(): void {

        if (Schema::hasColumn('profiles', 'user')) {

            Schema::table('profiles', function(Blueprint $table) {

                $table->dropConstrainedForeignId('user');

            });

        }

    }

};
