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
        Schema::create('serum_landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('header_title');
            $table->integer('first_product_id');
            $table->integer('second_product_id');
            $table->text('useful_list_name');
            $table->text('why_list_name');
            $table->text('video_link')->nullable();
            $table->string('facebook_link');
            $table->string('phone_number');
            $table->text('images');
            $table->boolean('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serum_landing_pages');
    }
};
