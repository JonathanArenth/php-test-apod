<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use App\Service\HttpService\HttpClientService;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixture extends Fixture
{
    public function __construct(
        private HttpClientService $httpClientService,
    ){}
    
    public function load(ObjectManager $manager): void
    {
        //for generate a testData
        $dataTest = $this->httpClientService->fetchNasaPictureOfDay('GET', 'https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&count=5');
        foreach($dataTest as $data){
            $picture = new Picture();
            $picture->setTitle($data['title']);
            $picture->setExplanation($data['explanation']);
            $picture->setDate(new DateTime($data['date']));
            $picture->setImage($data['hdurl']);
            $manager->persist($picture);
        }
        $manager->flush();
    }
}
