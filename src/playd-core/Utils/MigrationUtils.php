<?php

namespace Allumina\Playd\Core\Utils;

use Allumina\Playd\Core\Common\Constants;

class MigrationUtils
{
    public static function initializeBaseModelProperties(&$table)
    {
        $table->uuid('uid')->unique();
        $table->char('type', Constants::IDENTIFIER_LENGTH)->nullable();
        $table->char('category', Constants::IDENTIFIER_LENGTH)->nullable();
        $table->boolean('isVisible')->default(false);
        $table->boolean('isEnabled')->default(false);
        $table->boolean('isDeleted')->default(false);
        $table->unsignedInteger('flags')->default(0);
        $table->uuid('localId')->nullable();
        $table->uuid('ownerId')->nullable();
        $table->uuid('userId')->nullable();
        $table->uuid('parentId')->nullable();
        $table->uuid('ancestorId')->nullable();
        $table->uuid('groupId')->nullable();
        $table->uuid('applicationId')->nullable();
        $table->uuid('environmentId')->nullable();
        $table->unsignedInteger('version')->default(0);
        $table->timestamp('createTime')->nullable();
        $table->timestamp('updateTime')->nullable();
        $table->timestamp('deleteTime')->nullable();
        $table->char('hash', Constants::HASH_LENGTH)->nullable();

        $table->primary('uid');
        $table->index('ownerId');
        $table->index('userId');
        $table->index('parentId');
        $table->index('ancestorId');
        $table->index('groupId');
        $table->index('applicationId');
        $table->index('environmentId');
    }
}
