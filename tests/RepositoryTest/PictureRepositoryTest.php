<?php
namespace App\Tests\RepositoryTest;

use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PictureRepositoryTest extends KernelTestCase
{
    /** test le bon fonctionnement du repository en récupérant le nombre 
     * d'enregistremenrt dans la table **/
    public function testCount()
    {
        self::bootKernel();
        $pictures = self::$container->get(PictureRepository::class)->count([]);
        $this->assertEquals(5, $pictures);
    }
}