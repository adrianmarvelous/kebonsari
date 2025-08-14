<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // menu name
            $table->string('url')->nullable(); // optional link/url
            $table->string('icon')->nullable(); // optional icon class
            $table->unsignedBigInteger('parent_id')->nullable(); // for submenu
            $table->integer('order')->default(0); // menu order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
