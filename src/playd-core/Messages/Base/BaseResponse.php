<?php

namespace Allumina\Playd\Core\Messages\Base;

abstract class BaseResponse
{
    public const UNDEFINED = -1;
    public const OK = 200;
    public const CREATED = 201;
    public const NO_CONTENT = 204;
    public const PARTIAL_CONTENT = 206;
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const INTERNAL_ERROR = 500;
    public const BAD_GATEWAY = 502;
    public const SERVICE_UNAVAILABLE = 503;

    public function __construct()
    {
        $this->data = [];
        $this->status = self::UNDEFINED;
        $this->page = 0;
        $this->count = 0;
        $this->error = null;
        $this->debug = null;
    }
}
