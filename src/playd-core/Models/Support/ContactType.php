<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 2019-03-14
 * Time: 11:48
 */

namespace Allumina\Playd\Core\Models\Support;

use Allumina\Playd\Core\Models\Base\BaseEnumeration;
use Allumina\Playd\Core\Models\Interfaces\IEnumeration;

final class ContactType extends BaseEnumeration implements IEnumeration
{
    public const MOBILE = 100;
    public const PHONE = 110;
    public const FAX = 120;
    public const WEBSITE = 130;
    public const EMAIL = 140;
    public const HOME = 150;

    public const MOBILE_IDENTIFIER = 'mobile';
    public const PHONE_IDENTIFIER = 'phone';
    public const FAX_IDENTIFIER = 'fax';
    public const WEBSITE_IDENTIFIER = 'website';
    public const EMAIL_IDENTIFIER = 'email';
    public const HOME_IDENTIFIER = 'home';

    public static function all()
    {
        $output = array();
        array_push($output, new ContactType(self::UNDEFINED, self::UNDEFINED_IDENTIFIER));
        array_push($output, new ContactType(self::MOBILE, self::MOBILE_IDENTIFIER));
        array_push($output, new ContactType(self::PHONE, self::PHONE_IDENTIFIER));
        array_push($output, new ContactType(self::FAX, self::FAX_IDENTIFIER));
        array_push($output, new ContactType(self::WEBSITE, self::WEBSITE_IDENTIFIER));
        array_push($output, new ContactType(self::EMAIL, self::EMAIL_IDENTIFIER));
        array_push($output, new ContactType(self::HOME, self::HOME_IDENTIFIER));
        return $output;
    }

    public static function localize($value)
    {
        return __('contact_types.' . $value);
    }
}