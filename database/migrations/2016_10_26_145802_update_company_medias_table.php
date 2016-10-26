<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyMediasTable extends Migration {

    public function up() {
        Schema::table('company_medias', function ($table) {
            $table->string('file_name', 100)->change();
        });
    }

    public function down() {
        Schema::table('company_medias', function ($table) {
            $table->string('file_name', 255)->change();
        });
    }
}
