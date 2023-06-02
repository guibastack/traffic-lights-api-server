<?php

use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('auth_tokens', function(Blueprint $table) {

            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->timestamps();
            $table->string('auth_token');

        });

    }

    public function down(): void {

        if (Schema::hasTable('auth_tokens')) {

            Schema::drop('auth_tokens');

        }

    }

};
