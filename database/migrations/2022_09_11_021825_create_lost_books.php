<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lost_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id')->nullable();
            $table->unsignedBigInteger('requested_book_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            $table->date('date_of_incident')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approver')->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('requested_book_id')->references('id')->on('requested_books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('approver')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lost_books');
    }
}
