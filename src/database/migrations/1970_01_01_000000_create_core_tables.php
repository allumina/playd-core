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
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('native_name', 256)->nullable();
            $table->string('display_name', 256)->nullable();
            $table->string('english_name', 256)->nullable();
            $table->string('number_format', 256)->nullable();
            $table->string('two_letter_iso_language_name', 8)->nullable();
            $table->string('three_letter_iso_language_name', 8)->nullable();
        });

        Schema::create('core_countries', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('name', 256)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
        });

        Schema::create('core_groups', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('name', 512)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('core_roles', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->text('description')->nullable();
        });

        Schema::create('core_users', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
        });

        Schema::create('core_assets', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('filename', 512)->nullable();
            $table->string('original_filename', 512)->nullable();
            $table->unsignedInteger('filesize')->nullable();
            $table->string('url', 512)->nullable();
            $table->string('mime', 64)->nullable();
        });

        Schema::create('core_geo', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('address', 512)->nullable();
            $table->string('city', 256)->nullable();
            $table->string('district', 256)->nullable();
            $table->string('postal_code', 32)->nullable();
            $table->string('country', 16)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->string('region', 256)->nullable();
            $table->string('zone', 256)->nullable();
        });

        Schema::create('coupled_roles', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::create('coupled_groups', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::create('coupled_assets', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::create('core_tags', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentProperties($table);

        });

        Schema::create('core_posts', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentProperties($table);

            $table->text('title')->nullable();
            $table->text('slug')->unique();
            $table->longText('launch')->nullable();
            $table->longText('abstract')->nullable();
            $table->longText('body')->nullable();
            $table->longText('text')->nullable();
            $table->string('cover')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_tags');
        Schema::dropIfExists('core_posts');

        Schema::dropIfExists('coupled_roles');
        Schema::dropIfExists('coupled_groups');
        Schema::dropIfExists('coupled_assets');

        Schema::dropIfExists('core_assets');
        Schema::dropIfExists('core_geo');
        Schema::dropIfExists('core_groups');
        Schema::dropIfExists('core_roles');
        Schema::dropIfExists('core_users');
        Schema::dropIfExists('core_countries');
        Schema::dropIfExists('core_locales');
    }
}
