<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enrollment_id'); // Foreign key referencing the enrollments table
            $table->unsignedBigInteger('lesson_id'); // Foreign key referencing the lessons table
            $table->boolean('is_completed')->default(false); // Tracks lesson completion
            $table->timestamps();

            // Foreign keys
            $table->foreign('enrollment_id')->references('id')->on('enrollments')->onDelete('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
