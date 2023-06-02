<?php

use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('bearer_tokens', function(Blueprint $table) {

            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->string('bearer_token');
            $table->timestamps();

        });

    }

    public function down(): void {

        if (Schema::hasTable('bearer_tokens')) {

            Schema::drop('bearer_tokens');

        }

    }

};
