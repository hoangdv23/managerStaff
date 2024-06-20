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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Tên Job
            $table->string('customer_id')->nullable(); // Tên Job
            $table->string('status')->nullable(); // Trạng Thái
            $table->unsignedBigInteger('user_id')->nullable(); // user_id
            $table->unsignedBigInteger('marketing_user_id')->nullable(); // marketing_user_id
            $table->integer('number_img')->nullable(); // number_img
            $table->string('type')->nullable(); // type
            $table->date('start_date')->nullable(); // start date
            $table->date('finish_date')->nullable(); // finish date
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
        Schema::dropIfExists('jobs');
    }
}