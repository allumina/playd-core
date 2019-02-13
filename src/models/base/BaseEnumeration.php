<?php

namespace Allumina\Playd\Models\Base;

use Ramsey\Uuid\Uuid;
use App\Models\Common\Constants;

class BaseEnumeration
{
    public const UNDEFINED = 0;
    public const UNDEFINED_IDENTIFIER = 'undefined';

    public $uid;
    public $identifier;

    public function __construct(int $uid, string $identifier)
    {
        $this->uid = $uid;
        $this->identifier = $identifier;
    }

    protected function __initialize(
        int $uid,
        string $identifier
    ) {
        $this->uid = $uid;
        $this->identifier = $identifier;
    }

    public function assignId()
    {
        $this->uid = Uuid::uuid4()->toString();
    }
}
