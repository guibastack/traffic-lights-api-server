<?php

use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasTable('bearer_tokens')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->datetime('expires_at');

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('bearer_tokens', 'expires_at')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->dropColumn('expires_at');

            });

        }

    }

};
