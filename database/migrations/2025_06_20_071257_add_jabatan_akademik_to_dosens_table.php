<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dosens', function (Blueprint $table) {
            if (!Schema::hasColumn('dosens', 'jabatan_akademik')) {
                $table->string('jabatan_akademik')->nullable()->after('nip');
            }
        });
    }

    public function down()
    {
        Schema::table('dosens', function (Blueprint $table) {
            if (Schema::hasColumn('dosens', 'jabatan_akademik')) {
                $table->dropColumn('jabatan_akademik');
            }
        });
    }
};
