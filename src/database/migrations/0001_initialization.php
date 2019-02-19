<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Utils\MigrationUtils;
use App\Models\Common\Constants;

class Initialization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         *
         */
        /*
        * Global
        */
        Schema::create('locales', function (Blueprint $table) {
            MigrationUtils::initializeBaseProperties($table);
        });

        /*
        * General Info
        */
        Schema::create('general_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->date('birthDate')->nullable();
            $table->unsignedInteger('gender')->nullable();
            $table->unsignedInteger('bloodGroup')->nullable();

            // Special properties
            $table->boolean('dumb')->nullable();
            $table->boolean('deaf')->nullable();
            $table->unsignedInteger('handicap')->nullable();

            // Female related fields
            $table->boolean('isPregnant')->nullable();
            $table->boolean('inMenopause')->nullable();
            $table->date('lastMenstruationDate')->nullable();
        });

        /*
        * Lifestyle
        */
        Schema::create('lifestyles', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->unsignedInteger('diet'); //Diet
            $table->unsignedInteger('alcohol'); // Occurrence
            $table->unsignedInteger('smoke'); // Occurrence
            $table->unsignedInteger('activity'); // Frequency
            $table->unsignedInteger('sleep'); // Sleep
            $table->unsignedInteger('drugs'); // Drugs
        });

        /*
        * Measurements
        */
        Schema::create('measurement_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('measurement_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('measurements', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('measurement_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('measurement_categories')->onDelete('set null');
        });

        Schema::create('measurement_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('measurementId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('measurementId')->references('uid')->on('measurements')->onDelete('set null');

            // $table->unique(['measurementId','locale']);
        });

        Schema::create('measurement_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->double('value')->nullable();
            $table->double('last')->nullable();
            $table->double('max')->nullable();
            $table->double('min')->nullable();
            $table->double('average')->nullable();
            $table->double('count')->nullable();
            $table->double('trend')->nullable();
            $table->double('perceptive')->nullable();
            $table->unsignedInteger('day')->nullable();
            $table->unsignedInteger('week')->nullable();
            $table->unsignedInteger('month')->nullable();
            $table->unsignedInteger('year')->nullable();
            $table->unsignedInteger('unit')->default(0);
            $table->unsignedInteger('interval')->default(0);
            $table->timestamp('startTime')->nullable();
            $table->timestamp('endTime')->nullable();
            $table->uuid('measurementId')->nullable();
            $table->foreign('measurementId')->references('uid')->on('measurements')->onDelete('set null');
        });

        /*
        * Thresholds
        */
        Schema::create('thresholds', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->unsignedInteger('operator')->default(0);
            $table->unsignedInteger('unit')->default(0);
            $table->double('value')->nullable();
            $table->string('formula')->nullable();
            $table->string('execute')->nullable(); // TO DO: define how execute
            $table->uuid('measurementId')->nullable();
            $table->foreign('measurementId')->references('uid')->on('measurements')->onDelete('set null');
        });

        /*
        * Diseases
        */
        Schema::create('disease_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('disease_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('diseases', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('disease_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('disease_categories')->onDelete('set null');
        });

        Schema::create('disease_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('diseaseId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('diseaseId')->references('uid')->on('diseases')->onDelete('set null');

            // $table->unique(['diseaseId','locale']);
        });

        Schema::create('disease_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('diseaseId')->nullable();
            $table->foreign('diseaseId')->references('uid')->on('diseases')->onDelete('set null');
        });

        /*
        * Allergies
        */
        Schema::create('allergy_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('allergy_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('allergies', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('allergy_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('allergy_categories')->onDelete('set null');
        });

        Schema::create('allergy_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('allergyId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('allergyId')->references('uid')->on('allergies')->onDelete('set null');

            // $table->unique(['allergyId','locale']);
        });

        Schema::create('allergy_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->string('effects')->nullable();
            $table->string('notes')->nullable();
            $table->uuid('allergyId')->nullable();
            $table->foreign('allergyId')->references('uid')->on('allergies')->onDelete('set null');
        });


        /*
        * Injuries
        */
        Schema::create('injury_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('injury_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('injuries', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('injury_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('injury_categories')->onDelete('set null');
        });

        Schema::create('injury_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('injuryId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('injuryId')->references('uid')->on('injuries')->onDelete('set null');

            // $table->unique(['injuryId','locale']);
        });

        Schema::create('injury_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->timestamp('timestamp')->nullable();
            $table->unsignedInteger('year')->nullable();
            $table->uuid('injuryId')->nullable();
            $table->foreign('injuryId')->references('uid')->on('injuries')->onDelete('set null');
        });

        /*
        * Surgery
        */
        Schema::create('surgery_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('surgery_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('surgeries', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('surgery_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('surgery_categories')->onDelete('set null');
        });

        Schema::create('surgery_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('surgeryId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('surgeryId')->references('uid')->on('surgeries')->onDelete('set null');

            // $table->unique(['surgeryId','locale']);
        });

        Schema::create('surgery_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->timestamp('timestamp')->nullable();
            $table->unsignedInteger('year')->nullable();
            $table->string('notes');
            $table->uuid('surgeryId')->nullable();
            $table->foreign('surgeryId')->references('uid')->on('surgeries')->onDelete('set null');
        });

        /*
        * Therapies
        */
        Schema::create('therapy_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('therapy_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('therapies', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('therapy_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('therapy_categories')->onDelete('set null');
        });

        Schema::create('therapy_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('therapyId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('therapyId')->references('uid')->on('therapies')->onDelete('set null');

            // $table->unique(['vaccinationId','locale']);
        });

        Schema::create('therapy_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->string('notes');
            $table->timestamp('startTime')->nullable();
            $table->timestamp('endTime')->nullable();
            $table->string('scheduling')->nullable();
            $table->unsignedInteger('year')->nullable();
            $table->unsignedInteger('duration')->default(0); // in days
            $table->uuid('therapyId')->nullable();
            $table->foreign('therapyId')->references('uid')->on('therapies')->onDelete('set null');
        });

        /*
        * Examinations
        */
        Schema::create('examination_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('examination_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('examinations', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('examination_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('examination_categories')->onDelete('set null');
        });

        Schema::create('examination_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('examinationId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('examinationId')->references('uid')->on('examinations')->onDelete('set null');
        });

        Schema::create('examination_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->string('notes');
            $table->timestamp('timestamp')->nullable();
            $table->uuid('examinationId')->nullable();
            $table->foreign('examinationId')->references('uid')->on('examinations')->onDelete('set null');
        });

        /*
        * Vaccination
        */
        Schema::create('vaccination_types', function (Blueprint $table) {
            MigrationUtils::initializeTypeProperties($table);
        });

        Schema::create('vaccination_categories', function (Blueprint $table) {
            MigrationUtils::initializeCategoryProperties($table);
        });

        Schema::create('vaccinations', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->foreign('type')->references('identifier')->on('vaccination_types')->onDelete('set null');
            $table->foreign('category')->references('identifier')->on('vaccination_categories')->onDelete('set null');
        });

        Schema::create('vaccination_infos', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->uuid('vaccinationId')->nullable();
            $table->char('locale', Constants::LOCALE_IDENTIFIER_LENGTH)->nullable();
            $table->string('shortDescription')->nullable();
            $table->string('fullDescription')->nullable();
            $table->foreign('vaccinationId')->references('uid')->on('vaccinations')->onDelete('set null');

            // $table->unique(['vaccinationId','locale']);
        });

        Schema::create('vaccination_items', function (Blueprint $table) {
            MigrationUtils::initializeModelProperties($table);
            $table->string('notes');
            $table->boolean('isRecall')->default(false);
            $table->date('date')->nullable();
            $table->uuid('vaccinationId')->nullable();
            $table->foreign('vaccinationId')->references('uid')->on('vaccinations')->onDelete('set null');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        Schema::drop('disease_items');
        Schema::drop('disease_infos');
        Schema::drop('diseases');
        Schema::drop('disease_types');
        Schema::drop('disease_categories');

        Schema::drop('thresholds');

        Schema::drop('measurement_items');
        Schema::drop('measurement_infos');
        Schema::drop('measurements');
        Schema::drop('measurement_types');
        Schema::drop('measurement_categories');

        Schema::drop('surgery_items');
        Schema::drop('surgery_infos');
        Schema::drop('surgeries');
        Schema::drop('surgery_types');
        Schema::drop('surgery_categories');

        Schema::drop('injury_items');
        Schema::drop('injury_infos');
        Schema::drop('injuries');
        Schema::drop('injury_types');
        Schema::drop('injury_categories');

        Schema::drop('allergy_items');
        Schema::drop('allergy_infos');
        Schema::drop('allergies');
        Schema::drop('allergy_types');
        Schema::drop('allergy_categories');

        Schema::drop('therapy_items');
        Schema::drop('therapy_infos');
        Schema::drop('therapies');
        Schema::drop('therapy_types');
        Schema::drop('therapy_categories');

        Schema::drop('examination_items');
        Schema::drop('examination_infos');
        Schema::drop('examinations');
        Schema::drop('examination_types');
        Schema::drop('examination_categories');

        Schema::drop('vaccination_items');
        Schema::drop('vaccination_infos');
        Schema::drop('vaccinations');
        Schema::drop('vaccination_types');
        Schema::drop('vaccination_categories');

        Schema::drop('lifestyles');

        Schema::drop('general_infos');

        Schema::drop('locales');
        */
    }
}
