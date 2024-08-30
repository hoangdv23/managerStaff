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
        Schema::table('jobs_have_type_service', function (Blueprint $table) {
            $table->string('status')->after('checked_link')->default('pending'); // Bạn có thể thay 'existing_column' bằng tên cột hiện có trong bảng
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs_have_type_service', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};