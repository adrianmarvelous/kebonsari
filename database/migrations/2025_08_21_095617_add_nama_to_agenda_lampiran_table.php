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
        Schema::table('agenda_lampiran', function (Blueprint $table) {
            $table->string('nama')->after('id_agenda'); // add before file, so put after id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agenda_lampiran', function (Blueprint $table) {
            $table->dropColumn('nama');
        });
    }
};
