<?php

namespace Allumina\Playd\Core\Models\Base;

use Ramsey\Uuid\Uuid;
use App\Models\Common\Constants;

class BaseEnumeration
{
    public const UNDEFINED = 0;
    public const UNDEFINED_IDENTIFIER = 'undefined';

    public $uid;
    public $identifier;
    public $description;

    public function __construct(int $uid, string $identifier, string $description = null)
    {
        $this->uid = $uid;
        $this->identifier = $identifier;
        $this->description = $description;
    }

    protected function __initialize(
        int $uid,
        string $identifier,
        string $description
    ) {
        $this->uid = $uid;
        $this->identifier = $identifier;
        $this->description = $description;
    }

    public function assignId()
    {
        $this->uid = Uuid::uuid4()->toString();
    }
}
