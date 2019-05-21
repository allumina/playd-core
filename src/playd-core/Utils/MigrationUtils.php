<?php

namespace Allumina\Playd\Core\Utils;

use Allumina\Playd\Core\Common\Constants;

class MigrationUtils
{
    public static function initializeBaseModelProperties(&$table)
    {
        $table->uuid('uid')->unique();
        $table->uuid('identifier')->nullable();
        $table->string('friendly', 256)->nullable();
        $table->string('type', Constants::IDENTIFIER_LENGTH)->nullable();
        $table->string('category', Constants::IDENTIFIER_LENGTH)->nullable();
        $table->unsignedInteger('sort_index')->default(0);
        $table->boolean('is_visible')->default(false);
        $table->boolean('is_enabled')->default(false);
        $table->boolean('is_deleted')->default(false);
        $table->unsignedInteger('flags')->default(0);
        $table->string('locale', 16)->default('');
        $table->uuid('local_id')->nullable();
        $table->uuid('owner_id')->nullable();
        $table->uuid('user_id')->nullable();
        $table->uuid('parent_id')->nullable();
        $table->uuid('ancestor_id')->nullable();
        $table->uuid('group_id')->nullable();
        $table->uuid('external_id')->nullable();
        $table->uuid('application_id')->nullable();
        $table->uuid('environment_id')->nullable();
        $table->unsignedInteger('version')->default(0);
        $table->timestamp('create_time')->nullable();
        $table->timestamp('update_time')->nullable();
        $table->timestamp('delete_time')->nullable();
        $table->string('hash', Constants::HASH_LENGTH)->nullable();
        $table->text('raw')->nullable();
        $table->text('acl')->nullable();

        /*
        if ($uidAsPrimary) {
            $table->primary(['uid', 'locale']);
        }  else {
            $table->unique(['uid', 'locale']);
        }
        */

        $table->primary(['identifier', 'locale']);

        $table->index('identifier');
        $table->index('locale');
        $table->index('owner_id');
        $table->index('user_id');
        $table->index('parent_id');
        $table->index('ancestor_id');
        $table->index('group_id');
        $table->index('application_id');
        $table->index('environment_id');
        $table->index('external_id');

        // if ($table->getTable() != 'core_locales')
        //     $table->foreign('locale')->references('identifier')->on('core_locales');
    }

    public static function initializeBaseContentProperties(&$table)
    {

    }
}
