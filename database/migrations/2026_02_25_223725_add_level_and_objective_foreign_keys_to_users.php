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
        // Ensure columns exist (in case users table was created before columns were added)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'level_id')) {
                $table->unsignedBigInteger('level_id')->nullable()->index();
            }

            if (!Schema::hasColumn('users', 'objective_id')) {
                $table->unsignedBigInteger('objective_id')->nullable()->index();
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'level_id')) {
                $table->foreign('level_id')->references('id')->on('levels')->nullOnDelete();
            }

            if (Schema::hasColumn('users', 'objective_id')) {
                $table->foreign('objective_id')->references('id')->on('objectives')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropForeign(['objective_id']);
        });
    }
};
