<?php
namespace App\Tests\RepositoryTest;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /** test le bon fonctionnement du repository en récupérant le nombre 
     * d'enregistremenrt dans la table **/
    public function testCount()
    {
        self::bootKernel();
        $users = self::$container->get(UserRepository::class)->count([]);
        $this->assertEquals(4, $users);
    }
}