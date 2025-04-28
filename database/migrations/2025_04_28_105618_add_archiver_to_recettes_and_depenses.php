<?php 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArchiverToRecettesAndDepenses extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('recettes', 'archiver')) {
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
}
