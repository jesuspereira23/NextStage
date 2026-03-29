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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'level_id')) {
                $table->unsignedBigInteger('level_id')->nullable()->index();
            }

            if (!Schema::hasColumn('users', 'objective_id')) {
                $table->unsignedBigInteger('objective_id')->nullable()->index();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'level_id')) {
                $table->dropColumn('level_id');
            }

            if (Schema::hasColumn('users', 'objective_id')) {
                $table->dropColumn('objective_id');
            }
        });
    }
};
