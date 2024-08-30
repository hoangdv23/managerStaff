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
            $table->string('amount')->nullable()->after('job_id');  // Thay 'last_column' bằng tên cột cuối cùng trong bảng của bạn
            $table->string('fixed_link')->nullable()->after('amount');
            $table->unsignedBigInteger('user_id')->nullable(); // user_id
            $table->unsignedBigInteger('marketing_user_id')->nullable(); // marketing_user_id
            $table->string('edited_link')->nullable()->after('fixed_link');
            $table->string('checked_link')->nullable()->after('edited_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
