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
        Schema::create('agenda_lampiran', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_agenda'); // Foreign key to agenda
            $table->string('file'); // File lampiran
            $table->timestamps(); // created_at & updated_at

            // Add foreign key constraint
            $table->foreign('id_agenda')
                  ->references('id')
                  ->on('agenda')
                  ->onDelete('cascade'); // If agenda deleted, delete lampirannya juga
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_lampiran');
    }
};
