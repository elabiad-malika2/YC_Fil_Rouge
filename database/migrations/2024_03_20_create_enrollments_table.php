<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('payment_status')->default('pending');
            $table->string('payment_id')->nullable();
            $table->string('status')->default('in_progress');
            $table->integer('progress')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}; 