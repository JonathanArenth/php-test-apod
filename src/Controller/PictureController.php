<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PictureController extends AbstractController
{
    /**
     * @Route("/dayPicture", name="day_picture")
     */
    public function getDayPicture(
        PictureRepository $pictureRepository,
    ): Response
    {
        $picture = $pictureRepository->findOneBy([], ['id' => 'desc']);
        $userConnected = $this->getUser();
        if ($userConnected instanceof User){
            $user = $userConnected->getFullName();
            $avatar = $userConnected->getAvatar();
            $dataPicture = [
                'title' => $picture->getTitle(),
                'explanation' => $picture->getExplanation(),
                'date' => $picture->getDate()->format('Y-m-d'),
                'image' => $picture->getImage(),
                'user' => $user,
                'avatar' => $avatar
            ]; 
        }
        return $this->render('pages/dayPicture.html.twig', $dataPicture);
    }
}
