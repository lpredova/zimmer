<?php

class ApartmentsSeeder extends DatabaseSeeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++) {
            Apartment::create(array(
                "owner_id" => $faker->numberBetween($min = 2, $max = 99),
                "type_id" => $faker->numberBetween($min = 1, $max = 4),
                "city_id" => $faker->numberBetween($min = 1, $max = 7),
                "name" => $faker->firstName($gender = 'male' | 'female'),
                "description" => $faker->text(400),
                "capacity" => $faker->numberBetween($min = 1, $max = 10),
                "stars" => 0,
                "address" => $faker->address,
                "email" => $faker->email,
                "phone" => $faker->phoneNumber,
                "phone_2" => $faker->phoneNumber,
                "rating" => $faker->numberBetween($min = 0, $max = 5),
                "lat" => $faker->randomFloat($nbMaxDecimals = 6, $min = 42.25, $max = 46.60),
                "lng" => $faker->randomFloat($nbMaxDecimals = 6, $min = 13.56, $max = 19.38),
                "price" => $faker->numberBetween($min = 10, $max = 120),
                "special" => $faker->boolean($chanceOfGettingTrue = 10),
                "active" => $faker->boolean($chanceOfGettingTrue = 98),
                "cover_photo" => $faker->randomElement($array = array(
                    'http://www.croatianvillas.com/upload/images/big/IS105-luxury-croatia-01big.jpg',
                    'http://croatiaaa.me/wp-content/plugins/widgetkit_full/cache/gallery/2167/141_brac_vacation_holiday_accommodation_apartments_suites_rooms_privacy_direct_sea_view_dalmatia_island_croatia_split_beach_entertainment_supetar_villa_luxury_family_wedding_summer_winter_spring_romantic_01-14cf6e7a67.png',
                    'http://www.travel-tourist.com/pictures/objekti/3831/0.jpg',
                    'http://www.croatianvillaholidays.com/images/liberty2/main.jpg',
                    'https://static.squarespace.com/static/53bd00aae4b04ee6a0986e13/5423b907e4b03f0c482aa4d5/5423b907e4b03f0c482aa4da/1407837501382/01.jpg',
                    'http://www.croatianvillaholidays.com/images/natasha/mainM.jpg',
                    'http://www.unikat-villas.com/images/Slider1.jpg',
                    'http://www.santo-bol-croatia.com/var/santo/storage/images/croatia-luxury-villas-holiday-pool-houses/istria-luxury-pool-holiday-house-rustica/istria-croatia-luxury-villa-rustica-12/58771-1-eng-GB/Istria-Croatia-Luxury-Villa-Rustica-12_gallerylarge.jpg',
                    'http://www.villascroatia.net/941307-3110.jpg?20130206',
                    'http://yacht-charter-croatia.eu/images/made/images/slike/466/villa-eva-001__large_640_457_s.jpg',
                    'http://lord-yachting.com/photosvilla/villa_orebic2-4b.jpg',
                    'http://croatia-exclusive.eu/data/smjestaj/images/Dalmatian-Luxury-Villa-Splendida-with-pool-by-the-sea-ideal-for-luxury-elite-and-family-vacation-Luxury-seaside-villa-with-pool-Milna-Brac-Dalmatia-Croatia-17207_1418287274.jpg',
                    'http://www.villasinluxury.com/attachments/photos/gallery/LuxuryGoldenRayVilla110.jpeg',
                    'http://cdclifestyle.com/wp-content/uploads/2012/11/Villa-Rental-Dalmatian-Coast-Croatia-4.jpg',
                    'http://www.bluesunhotels.com/EasyEdit/UserFiles/PageImages/hrvatsko-zagorje/hrvatsko-zagorje-635348976364508281-2_728_409.jpeg'
                )),
            ));
        }
    }
}

