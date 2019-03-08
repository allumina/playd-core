<?php

use Illuminate\Support\Facades\Schema;
use Allumina\Playd\Core\Utils\MigrationUtils as CoreMigrationUtils;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_locales', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table, false);

            $table->string('code', 16)->unique();
            $table->string('nativeName', 256)->nullable();
            $table->string('displayName', 256)->nullable();
            $table->string('englishName', 256)->nullable();
            $table->string('numberFormat', 256)->nullable();
            $table->string('twoLetterISOLanguageName', 8)->nullable();
            $table->string('threeLetterISOLanguageName', 8)->nullable();

            $table->primary('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_locales');
    }
}
