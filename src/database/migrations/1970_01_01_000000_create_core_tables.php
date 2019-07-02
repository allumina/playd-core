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
        Schema::connection('auth')->create('core_roles', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->text('description')->nullable();
        });

        Schema::connection('auth')->create('core_users', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
        });

        Schema::connection('auth')->create('core_password_resets', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            $table->string('email')->index();
            $table->string('token');
        });

        Schema::connection('data')->create('core_locales', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('native_name', 256)->nullable();
            $table->string('display_name', 256)->nullable();
            $table->string('english_name', 256)->nullable();
            $table->string('number_format', 256)->nullable();
            $table->string('two_letter_iso_language_name', 8)->nullable();
            $table->string('three_letter_iso_language_name', 8)->nullable();
        });

        Schema::connection('data')->create('core_countries', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('name', 256)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
        });

        Schema::connection('data')->create('core_applications', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('name', 512)->nullable();
            $table->text('description')->nullable();
        });

        Schema::connection('data')->create('core_groups', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('name', 512)->nullable();
            $table->text('description')->nullable();
        });

        Schema::connection('data')->create('core_assets', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('filename', 512)->nullable();
            $table->string('original_filename', 512)->nullable();
            $table->unsignedInteger('filesize')->nullable();
            $table->string('url', 512)->nullable();
            $table->string('mime', 64)->nullable();
        });

        Schema::connection('data')->create('core_geo', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('address', 512)->nullable();
            $table->string('city', 256)->nullable();
            $table->string('district', 256)->nullable();
            $table->string('postal_code', 32)->nullable();
            $table->string('country', 16)->nullable();
            $table->string('region', 256)->nullable();
            $table->string('zone', 256)->nullable();
        });

        Schema::connection('data')->create('core_contents', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeGenericContentModelProperties($table);
        });

        Schema::connection('data')->create('core_activities', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeGenericContentModelProperties($table);
        });

        Schema::connection('data')->create('core_user_infos', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
        });

        Schema::connection('data')->create('core_contacts', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->text('value', 256)->nullable();
        });

        Schema::connection('data')->create('coupled_activities', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedBigInteger('time')->nullable();
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::connection('data')->create('coupled_contents', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedBigInteger('time')->nullable();
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::connection('data')->create('coupled_roles', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::connection('data')->create('coupled_groups', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::connection('data')->create('coupled_assets', function (Blueprint $table) {
            $table->uuid('source_identifier');
            $table->uuid('target_identifier');
            $table->unsignedInteger('sort_index')->default(0);
            $table->primary(['source_identifier', 'target_identifier']);
            $table->index('source_identifier');
        });

        Schema::connection('data')->create('core_revisions', function (Blueprint $table) {
            CoreMigrationUtils::initializeBaseModelProperties($table);
            CoreMigrationUtils::initializeBaseContentModelProperties($table);
            $table->string('model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('data')->dropIfExists('coupled_activities');
        Schema::connection('data')->dropIfExists('coupled_contents');
        Schema::connection('data')->dropIfExists('coupled_roles');
        Schema::connection('data')->dropIfExists('coupled_groups');
        Schema::connection('data')->dropIfExists('coupled_assets');
        Schema::connection('data')->dropIfExists('core_revisions');
        Schema::connection('data')->dropIfExists('core_contacts');
        Schema::connection('data')->dropIfExists('core_activities');
        Schema::connection('data')->dropIfExists('core_contents');
        Schema::connection('data')->dropIfExists('core_assets');
        Schema::connection('data')->dropIfExists('core_geo');
        Schema::connection('data')->dropIfExists('core_groups');
        Schema::connection('data')->dropIfExists('core_roles');
        Schema::connection('data')->dropIfExists('core_user_infos');
        Schema::connection('data')->dropIfExists('core_users');
        Schema::connection('data')->dropIfExists('core_countries');
        Schema::connection('data')->dropIfExists('core_locales');
        Schema::connection('data')->dropIfExists('core_applications');
    }
}
