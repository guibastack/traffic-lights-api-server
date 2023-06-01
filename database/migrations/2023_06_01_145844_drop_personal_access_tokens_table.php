<?php

use Illuminate\Support\Facades\Schema as Schema;
use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

return new class extends Migration {

    public function up(): void {

        if (Schema::hasTable('personal_access_tokens')) {

            Schema::drop('personal_access_tokens');

        }

    }

    public function down(): void {}

};
