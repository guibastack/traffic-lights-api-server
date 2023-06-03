<?php

use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;
use Illuminate\Support\Facades\Schema as Schema;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasTable('bearer_tokens')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->datetime('manually_expired_by_user_at')->nullable();

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('bearer_tokens', 'manually_expired_by_user_at')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->dropColumn('manually_expired_by_user_at');

            });

        }

    }

};
