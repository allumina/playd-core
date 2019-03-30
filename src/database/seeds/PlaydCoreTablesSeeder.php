<?php

use \Illuminate\Database\Seeder;
use Allumina\Playd\Core\Models\LocaleModel;
use Allumina\Playd\Core\Models\CountryModel;

class PlaydCoreTablesSeeder extends Seeder
{
    public function run()
    {
        self::seedLocales();
        self::seedCountries();
    }

    private static function seedCountries() {
        $handle = fopen('database/seeds/data/countries.csv', 'r');
        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            $model = CountryModel::initialize($data[0],
                $data[3],
                (strlen($data[1]) > 1 ? floatval($data[1]) : null),
                (strlen($data[2]) > 1 ? floatval($data[2]) : null));
            $model->save();
        }
    }

    private static function seedLocales() {
        $handle = fopen('database/seeds/data/locales.csv', 'r');
        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            $model = LocaleModel::initialize($data[0],
                $data[1],
                $data[2],
                $data[3],
                $data[4],
                $data[5]);
            $model->save();
        }
    }
}