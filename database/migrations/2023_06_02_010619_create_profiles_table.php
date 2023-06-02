<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        Schema::create('profiles', function(Blueprint $table) {

            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->timestamps();
            $table->string('name')->nullable();

        });

    }

    public function down(): void {

        if (Schema::hasTable('profiles')) {

            Schema::drop('profiles');

        }

    }

};
