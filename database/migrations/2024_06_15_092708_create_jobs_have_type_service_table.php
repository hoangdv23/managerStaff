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
        Schema::create('jobs_have_type_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_service_id');
            $table->unsignedBigInteger('job_id');
            $table->timestamps();

            // Khai báo khóa ngoại cho type_service_id và job_id
            $table->foreign('type_service_id')->references('id')->on('type_services')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobss')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs_have_type_service', function (Blueprint $table) {
            // Xóa khai báo khóa ngoại trước khi drop table
            $table->dropForeign(['type_service_id']);
            $table->dropForeign(['job_id']);
        });

        Schema::dropIfExists('jobs_have_type_service');
    }
};
