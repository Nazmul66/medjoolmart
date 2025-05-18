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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->string('site_name');
            $table->string('whatsapp')->nullable();
            $table->string('phone');
            $table->string('phone_optional')->nullable();
            $table->string('email');
            $table->string('email_optional')->nullable();
            $table->text('address');
            $table->text('address_optional')->nullable();
            $table->text('google_map')->nullable();

            // Social Icons
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('instagram')->nullable();
            $table->text('pinterest')->nullable();
            $table->text('reddit')->nullable();
            $table->text('quora')->nullable();
            $table->text('thread')->nullable();

            // Conversion Tracking
            $table->text('facebook_pixel')->nullable();
            $table->text('google_analytics')->nullable();

            // Global changes 
            $table->string('currency_symbol')->nullable();
            $table->text('currency_name')->nullable();
            $table->text('timeZone')->nullable();

            // Footer
            $table->text('footer_logo')->nullable();
            $table->text('footer_text')->nullable();

            //Meta-data
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
