<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PictureControllerTest extends WebTestCase
{
    //public function testPicturePage()
    //{
    //    $client = static::createClient();
    //    $client->request('GET', '/dayPicture');
    //    $this->assertSelectorTextContains('h1', 'Nasa Picture');
    //}

    public function testPicturePagerestricted()
    {
        $client = static::createClient();
        $client->request('GET', '/dayPicture');
        $this->assertResponseStatusCodeSame(Response::HTTP_TEMPORARY_REDIRECT);
    }
}