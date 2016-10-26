<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyMediasTable2 extends Migration {

    public function up() {

        Schema::table('company_medias', function ($table) {
            $table->string('path')->after('file_name');
        });

    }

    public function down() {

        Schema::table('company_medias', function ($table) {
            $table->dropColumn('path');
        });

    }
}
