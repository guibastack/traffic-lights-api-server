<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('bearer_tokens', 'bearer_token')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->string('bearer_token')->collation('utf8mb4_0900_as_cs')->change();

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('bearer_tokens', 'bearer_token')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->string('bearer_token')->collation('utf8mb4_unicode_ci')->change();

            });

        }

    }

};
