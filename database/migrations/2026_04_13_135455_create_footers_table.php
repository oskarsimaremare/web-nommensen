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
    Schema::create('footers', function (Blueprint $table) {
        $table->id();
        $table->string('image');
        $table->text('link_instagram')->nullable();
        $table->text('link_youtube')->nullable();
        $table->text('link_linkedin')->nullable();
        $table->text('link_facebook')->nullable();
        $table->text('link_gmaps')->nullable();
        $table->string('alamat');
        $table->string('email');
        $table->string('wa');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
