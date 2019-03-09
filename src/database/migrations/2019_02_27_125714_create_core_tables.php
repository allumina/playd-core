<?php

use Illuminate\Support\Facades\Schema;
use Allumina\Playd\Core\Utils\MigrationUtils as CoreMigrationUtils;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoreTables extends Migration
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

        Schema::create('core_countries', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table, false);

            $table->string('code', 16)->unique();
            $table->string('name', 256)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            $table->primary('code');
        });

        Schema::create('core_geo', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);

            $table->string('address', 512)->nullable();
            $table->string('city', 256)->nullable();
            $table->string('district', 256)->nullable();
            $table->string('postalCode', 32)->nullable();
            $table->string('country', 16)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            $table->foreign('country')->references('code')->on('core_countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_geo');
        Schema::dropIfExists('core_countries');
        Schema::dropIfExists('core_locales');
    }
}
