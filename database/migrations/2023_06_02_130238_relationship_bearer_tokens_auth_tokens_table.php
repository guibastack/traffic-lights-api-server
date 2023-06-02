<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('auth_tokens', 'id') && Schema::hasTable('bearer_tokens')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->bigInteger('auth_token')->unsigned();

            });

            if (Schema::hasColumn('bearer_tokens', 'auth_token')) {

                Schema::table('bearer_tokens', function(Blueprint $table) {

                    $table->foreign('auth_token')->references('id')->on('auth_tokens');

                });

            }

        }

    }

    public function down(): void {

        if (Schema::hasColumn('bearer_tokens', 'auth_token')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->dropConstrainedForeignId('auth_token');

            });

        }

    }

};
