<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notifiable_id')->nullable();
            $table->unsignedBigInteger('notified_by')->nullable();
            $table->string('description')->nullable();
            $table->text('url')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->foreign('notifiable_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('notified_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
