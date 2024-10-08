<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobss', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Tên Job
            $table->string('customer_id')->nullable(); // Tên Job
            $table->string('status')->nullable(); // Trạng Thái
            $table->string('type')->nullable(); // type
            $table->dateTime('start_date')->nullable(); // start date
            $table->dateTime('finish_date')->nullable(); // finish date
            $table->string('note')->nullable(); // finish date
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobss');
    }
}