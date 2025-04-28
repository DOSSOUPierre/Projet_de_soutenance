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
    { if (!Schema::hasColumn('recettes', 'archiver')) {
        Schema::table('recettes', function (Blueprint $table) {
            $table->tinyInteger('archiver')->default(0);
        });
    }

    if (!Schema::hasColumn('depenses', 'archiver')) {
        Schema::table('depenses', function (Blueprint $table) {
            $table->tinyInteger('archiver')->default(0);
        });
    }
}

public function down()
{
    if (Schema::hasColumn('recettes', 'archiver')) {
        Schema::table('recettes', function (Blueprint $table) {
            $table->dropColumn('archiver');
        });
    }

    if (Schema::hasColumn('depenses', 'archiver')) {
        Schema::table('depenses', function (Blueprint $table) {
            $table->dropColumn('archiver');
        });
    }
}
};
