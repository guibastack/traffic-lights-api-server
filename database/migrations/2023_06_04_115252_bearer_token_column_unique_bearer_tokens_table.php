<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasColumn('bearer_tokens', 'bearer_token')) {

            Schema::table('bearer_tokens', function(Blueprint $table) {
                
                $table->string('bearer_token')->unique()->change();

            });

        }

    }

    public function down(): void {

        if (Schema::hasColumn('bearer_tokens', 'bearer_token')) {
            
            Schema::table('bearer_tokens', function(Blueprint $table) {

                $table->dropUnique(['bearer_token']);

            });

        }

    }

};
