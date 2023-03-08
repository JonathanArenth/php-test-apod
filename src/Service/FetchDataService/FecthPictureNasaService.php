<?php
namespace App\Service\FetchDataService;

use App\Entity\Picture;
use App\Repository\PictureRepository;
use App\Service\HttpService\HttpClientService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class FecthPictureNasaService
{
    public function __construct(
        private HttpClientService $httpClientService,
        private EntityManagerInterface $entityManager,
        private PictureRepository $pictureRepository,
        private ContainerBagInterface $params
    )
    {
        define('NASA_API_KEY', $this->params->get('nasa_api_key'));
    }

    public function fetchPicture()
    {
        $url = "https://api.nasa.gov/planetary/apod?api_key=" . NASA_API_KEY;
        $method = 'GET';
        $response = $this->httpClientService->fetchNasaPictureOfDay($method, $url);

        if ($response['media_type'] != 'image'){
            $lastDay = date('Y-m'). '-'. str_pad((date('d')-1), 2, '0', STR_PAD_LEFT);
            $url = $url . '&date='.$lastDay.'&concept_tags=True';
            $response = $this->httpClientService->fetchNasaPictureOfDay($method, $url);
        }
        
        $checkIfPictureExist = $this->pictureRepository->findOneBy(['date'=> new DateTime($response['date'])]);
        if (!$checkIfPictureExist){
            $picture = new Picture();
            $picture ->setTitle($response['title']);
            $picture->setExplanation($response['explanation']);
            $picture->setDate(new DateTime($response['date']));
            $picture->setImage($response['hdurl']);
            $this->entityManager->persist($picture);
            $this->entityManager->flush();
            return new JsonResponse([
                'message' => 'La photo ' . "'".$picture->getTitle()."'" . ' a bien été enregistrée.'
            ]);
        } else {
            return new JsonResponse([
                'message' => 'La photo en date du ' . $response['date'] . ' existe.'
            ]);
        }
    }
}