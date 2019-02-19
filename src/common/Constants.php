<?php

namespace Allumina\Playd\Common;

class Constants
{
    public const IDENTIFIER_LENGTH = 64;
    public const LOCALE_IDENTIFIER_LENGTH = 16;
    public const NAME_LENGTH = 256;
    public const URL_LENGTH = 512;
    public const HASH_ALGORITHM = 'sha256';
    public const HASH_LENGTH = 128;

    public const ENVIRONMENT_LEVEL_TEST = 100;
    public const ENVIRONMENT_LEVEL_STAGE = 500;
    public const ENVIRONMENT_LEVEL_PROD = 1000;

    public const ALL_KEYWORD = 'all';
}
