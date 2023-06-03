<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasTable('auth_tokens', 'expires_at')) {

            Schema::table('auth_tokens', function(Blueprint $table) {

                $table->datetime('expires_at')->nullable()->change();

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('auth_tokens', 'expires_at')) {

            Schema::table('auth_tokens', function(Blueprint $table) {

                $table->datetime('expires_at')->change();

            });

        }

    }

};
