<?php

namespace Allumina\Playd\Core\Utils;

use Allumina\Playd\Core\Common\Constants;

class MigrationUtils
{
    const IDS_LENGTH = 512;

    public static function initializeBaseModelProperties(&$table, array $primaryKeys = ['identifier', 'locale'])
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
        $table->string('local_id', self::IDS_LENGTH)->nullable();
        $table->string('owner_id', self::IDS_LENGTH)->nullable();
        $table->string('user_id', self::IDS_LENGTH)->nullable();
        $table->string('parent_id', self::IDS_LENGTH)->nullable();
        $table->string('ancestor_id', self::IDS_LENGTH)->nullable();
        $table->string('group_id', self::IDS_LENGTH)->nullable();
        $table->string('external_id', self::IDS_LENGTH)->nullable();
        $table->string('application_id', self::IDS_LENGTH)->nullable();
        $table->string('environment_id', self::IDS_LENGTH)->nullable();
        $table->unsignedInteger('version')->default(0);
        $table->timestamp('create_time')->nullable();
        $table->timestamp('update_time')->nullable();
        $table->timestamp('delete_time')->nullable();
        $table->string('hash', Constants::HASH_LENGTH)->nullable();
        $table->text('raw')->nullable();
        $table->text('acl')->nullable();

        $table->primary($primaryKeys);

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
    }

    public static function initializeBaseContentModelProperties(&$table)
    {
        $table->text('title')->nullable();
        $table->text('slug');
    }

    public static function initializeGenericContentModelProperties(&$table)
    {
        $table->text('title')->nullable();
        $table->text('slug');
        $table->longText('launch')->nullable();
        $table->longText('abstract')->nullable();
        $table->longText('body')->nullable();
        $table->string('cover')->nullable();
        $table->string('scheduling')->nullable();
        $table->unsignedBigInteger('start_time')->default(0);
        $table->unsignedBigInteger('end_time')->default(2147483648);
        $table->float('latitude')->nullable();
        $table->float('longitude')->nullable();
    }
}
