<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            "id" => 1,
            "name" => "Jordan Davila",
            "email" => "hi@jordandavila.com",
            "email_verified_at" => "2020-06-08 22:52:22",
            "password" => '$2y$10$FvRZke9Y.X2L3bi2JaE1uuqtDVHI34L88it9LlaW5Y80wTYTSF9JS',
            "remember_token" => "Hkr7XHHwqE2KG40RT2LPoIz6tExh6JDQFxKAhEUI3wTydFvYTkp7aSEfurLV",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        User::create([
            "id" => 2,
            "name" => "Cristian Ruiz",
            "email" => "info@terribooks.com",
            "email_verified_at" => "2020-06-08 22:52:22",
            "password" => '$2y$10$RnE71scOWz2PGxNi32Ve9uEnPA/YR7ZPEDGIbXDKKML3/9QzAc/jy',
            "remember_token" => "lDwPfREVuBjHgkPtgsP0Cjbjey1Bn0GoUwLPrNuXaDBrBb4ZY4R6u9njvUF3",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        User::create([
            "id" => 3,
            "name" => "Alejandro Sime",
            "email" => "alexsimedo@gmail.com",
            "email_verified_at" => null,
            "password" => '$2y$12$YX0AIoxrVHtpx2q1i4qPROUpXTrOqadUcj2z/wf.9onsR6L9N7E1G',
            "remember_token" => "RHaZTtAyB9D73ubOz796hvPeyB0UrE8dEDYyxP2nVwLCHfcbJT8mxbr8jLvG",
            "created_at" => "2020-06-28 16:50:50",
            "updated_at" => "2020-06-28 16:50:50",
        ]);

        User::create([
            "id" => 4,
            "name" => "Doug Keen",
            "email" => "dougkeen56@hmail.com",
            "email_verified_at" => null,
            "password" => '$2y$10$8xQbppoyxInNrxGxgfvMSuYt.Prwom0bdcwGw7Ig6lu/YLgMSXkgC',
            "remember_token" => null,
            "created_at" => "2020-07-07 09:31:40",
            "updated_at" => "2020-07-07 09:31:40",
        ]);

        User::create([
            "id" => 5,
            "name" => "Aleksandar Petran",
            "email" => "akipetran@gmail.com",
            "email_verified_at" => null,
            "password" => '$2y$10$hrEZFNv84JR1TQ.zH5Gkg.Rhal.493LvCg7mY6VQYQZHOEmNQhvka',
            "remember_token" => "AFU4URIwdpQ3xzqPlor4Jm0RWFohSoSnB27Gs1yY4EwRIpBhlEIe35DYJdVt",
            "created_at" => "2020-09-20 17:56:40",
            "updated_at" => "2020-09-20 17:56:40",
        ]);
    }
}
