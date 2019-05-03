<?php

use Illuminate\Support\Facades\Schema;
use Allumina\Playd\Core\Utils\MigrationUtils as CoreMigrationUtils;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_contacts', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->text('value', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_contacts');
    }
}
