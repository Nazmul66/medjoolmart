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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('thumb_image');
            $table->integer('vender_id')->nullable();
            $table->integer('category_id');
            $table->integer('subCategory_id')->nullable();
            $table->integer('childCategory_id')->nullable();
            $table->integer('brand_id');
            $table->integer('qty');
            $table->text('short_description')->nullable();
            $table->text('long_description');
            $table->text('video_link')->nullable();
            $table->string('sku')->nullable();
            $table->text('tags')->nullable();
            $table->double('price');
            $table->double('offer_price')->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->string('type')->default('new_arrived')->comment('new_arrived, featured, best, top');
            // $table->boolean('is_top')->nullable();
            // $table->boolean('is_best')->nullable();
            // $table->boolean('is_featured')->nullable();
            $table->integer('status')->default(1)->comment('1=Active, 0=Deactive');
            $table->integer('is_approved')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
