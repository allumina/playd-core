<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 20/02/19
 * Time: 15:55
 */

namespace Allumina\Playd\Core\Models;

use Allumina\Playd\Core\Models\Base\BaseContentModel;
use Illuminate\Support\Facades\DB;

abstract class ActivityCategories
{
    const PLACE = 'place';
    const ACTIVITY = 'activity';
    const SPORT = 'sport';
    const EXCURSION = 'excursion';
}

abstract class ActivityTypes
{
    const ACCOUNTING = 'accounting';
    const AIRPORT = 'airport';
    const AMUSEMENT_PARK = 'amusement_park';
    const AQUARIUM = 'aquarium';
    const ART_GALLERY = 'art_gallery';
    const ATM = 'atm';
    const BAKERY = 'bakery';
    const BANK = 'bank';
    const BAR = 'bar';
    const BEAUTY_SALON = 'beauty_salon';
    const BICYCLE_STORE = 'bicycle_store';
    const BOOK_STORE = 'book_store';
    const BOWLING_ALLEY = 'bowling_alley';
    const BUS_STATION = 'bus_station';
    const CAFE = 'cafe';
    const CAMPGROUND = 'campground';
    const CAR_DEALER = 'car_dealer';
    const CAR_RENTAL = 'car_rental';
    const CAR_REPAIR = 'car_repair';
    const CAR_WASH = 'car_wash';
    const CASINO = 'casino';
    const CEMETERY = 'cemetery';
    const CHURCH = 'church';
    const CITY_HALL = 'city_hall';
    const CLOTHING_STORE = 'clothing_store';
    const CONVENIENCE_STORE = 'convenience_store';
    const COURTHOUSE = 'courthouse';
    const DENTIST = 'dentist';
    const DEPARTMENT_STORE = 'department_store';
    const DOCTOR = 'doctor';
    const ELECTRICIAN = 'electrician';
    const ELECTRONICS_STORE = 'electronics_store';
    const EMBASSY = 'embassy';
    const FIRE_STATION = 'fire_station';
    const FLORIST = 'florist';
    const FUNERAL_HOME = 'funeral_home';
    const FURNITURE_STORE = 'furniture_store';
    const GAS_STATION = 'gas_station';
    const GYM = 'gym';
    const HAIR_CARE = 'hair_care';
    const HARDWARE_STORE = 'hardware_store';
    const HINDU_TEMPLE = 'hindu_temple';
    const HOME_GOODS_STORE = 'home_goods_store';
    const HOSPITAL = 'hospital';
    const INSURANCE_AGENCY = 'insurance_agency';
    const JEWELRY_STORE = 'jewelry_store';
    const LAUNDRY = 'laundry';
    const LAWYER = 'lawyer';
    const LIBRARY = 'library';
    const LIQUOR_STORE = 'liquor_store';
    const LOCAL_GOVERNMENT_OFFICE = 'local_government_office';
    const LOCKSMITH = 'locksmith';
    const LODGING = 'lodging';
    const MEAL_DELIVERY = 'meal_delivery';
    const MEAL_TAKEAWAY = 'meal_takeaway';
    const MOSQUE = 'mosque';
    const MOVIE_RENTAL = 'movie_rental';
    const MOVIE_THEATER = 'movie_theater';
    const MOVING_COMPANY = 'moving_company';
    const MUSEUM = 'museum';
    const NIGHT_CLUB = 'night_club';
    const PAINTER = 'painter';
    const PARK = 'park';
    const PARKING = 'parking';
    const PET_STORE = 'pet_store';
    const PHARMACY = 'pharmacy';
    const PHYSIOTHERAPIST = 'physiotherapist';
    const PLUMBER = 'plumber';
    const POLICE = 'police';
    const POST_OFFICE = 'post_office';
    const REAL_ESTATE_AGENCY = 'real_estate_agency';
    const RESTAURANT = 'restaurant';
    const ROOFING_CONTRACTOR = 'roofing_contractor';
    const RV_PARK = 'rv_park';
    const SCHOOL = 'school';
    const SHOE_STORE = 'shoe_store';
    const SHOPPING_MALL = 'shopping_mall';
    const SPA = 'spa';
    const STADIUM = 'stadium';
    const STORAGE = 'storage';
    const STORE = 'store';
    const SUBWAY_STATION = 'subway_station';
    const SUPERMARKET = 'supermarket';
    const SYNAGOGUE = 'synagogue';
    const TAXI_STAND = 'taxi_stand';
    const TRAIN_STATION = 'train_station';
    const TRANSIT_STATION = 'transit_station';
    const TRAVEL_AGENCY = 'travel_agency';
    const VETERINARY_CARE = 'veterinary_care';
    const ZOO = 'zoo';
}

class ActivityModel extends BaseContentModel
{
    public const CONTEXT = 'activity';

    protected $table = 'core_activities';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public static function initialize(
        $identifier,
        $friendly,
        $title,
        $launch,
        $abstract,
        $body,
        $text,
        $locale = '',
        $is_visible = true,
        $is_enabled = true,
        $is_deleted = false,
        $flags = 0
    ) {
        $instance = new self();

        $instance->title = $title;
        $instance->launch = $launch;
        $instance->abstract = $abstract;
        $instance->body = $body;
        $instance->text = $text;

        $instance->identifier = $identifier;
        $instance->friendly = $friendly;
        $instance->locale = $locale;
        $instance->is_visible = $is_visible;
        $instance->is_enabled = $is_enabled;
        $instance->is_deleted = $is_deleted;
        $instance->flags = $flags;

        return $instance;
    }

    public static function keysSeed()
    {
        return DB::table('core_activities')
            ->select('category', 'type')
            ->distinct()
            ->get();
    }
}

class ActivityModelRevision extends ActivityModel
{
    protected $table = 'core_activities_revisions';
}
