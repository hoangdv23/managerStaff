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
            // $table->string('editor_price')->nullable(); // Tên Job 
            $table->string('total_editor_price')->nullable(); // Tên Job 
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
