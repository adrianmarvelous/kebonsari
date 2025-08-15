<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // If the column does not exist, create it directly with default 3 and NOT NULL
        if (!Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')
                      ->default(3)
                      ->after('id')
                      ->nullable(false);
            });
        } else {
            // If the column exists, update existing null values first
            DB::table('users')->whereNull('role_id')->update(['role_id' => 3]);

            // Then modify the column to NOT NULL with default 3
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')
                      ->default(3)
                      ->nullable(false)
                      ->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable()->change();
        });
    }
};
