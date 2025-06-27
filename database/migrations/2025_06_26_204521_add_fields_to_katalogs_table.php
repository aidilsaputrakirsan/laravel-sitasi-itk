<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('katalogs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->unsignedBigInteger('sidang_ta_id')->nullable()->after('user_id');
            $table->enum('created_by', ['admin', 'mahasiswa'])->default('admin')->after('sidang_ta_id');
            $table->boolean('is_approved')->default(false)->after('created_by');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sidang_ta_id')->references('id')->on('sidang_ta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('katalogs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['sidang_ta_id']);
            $table->dropColumn(['user_id', 'sidang_ta_id', 'created_by', 'is_approved']);
        });
    }
};