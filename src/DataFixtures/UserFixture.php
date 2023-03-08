<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                "email" => "do0@themeforest.net",
                "roles" => [],
                "googleId" => "6abf15df-344f-41d9-85a5-9d4b7aa98dcf",
                "avatar" => "af40:83f:9706:490e:1929:fd8e:72d:3288",
                "hostedDomain" => null,
                "fullName" => "Dale Loughran"
            ], [
                "email"=> "mtyas0@sohu.com",
                "roles"=> [],
                "googleId"=> "7cb5a639-8c30-4039-bc9a-1deb8083158d",
                "avatar"=> "6bd8:8944:b43e:e1be:76a4:658e:5943:9e3d",
                "hostedDomain"=> null,
                "fullName"=> "Merridie Tyas"
            ],
            [
                "email"=> "adodamead1@nifty.com",
                "roles"=> [],
                "googleId"=> "becb1ac0-5434-44ed-a117-d2ee675d8415",
                "avatar"=> "2533:8202:fbd7:eedb:6c3b:92a8:142f:faad",
                "hostedDomain"=> "jiathis.com",
                "fullName"=> "Ariela Dodamead"
            ],
            [
                "email"=> "rlowdham2@mail.ru",
                "roles"=> [],
                "googleId"=> "77802ea9-b3ee-44f0-8b87-bac6f463d2f7",
                "avatar"=> "eba4:12ea:9f0:9069:3999:d8c0:20dc:1169",
                "hostedDomain"=> null,
                "fullName"=> "Rivi Lowdham"
            ]
        ];

        foreach ($users as $user){
            $newUser = new User();
            $newUser->setEmail($user['email']);
            $newUser->setRoles($user['roles']);
            $newUser->setGoogleId($user['googleId']);
            $newUser->setAvatar($user['avatar']);
            $newUser->setHostedDomain($user['hostedDomain']);
            $newUser->setFullName($user['fullName']);
            $manager->persist($newUser);
        }
        $manager->flush();
    }
}
