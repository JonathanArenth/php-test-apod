<?php
namespace App\Tests\EntityTest;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

final class UserTest extends KernelTestCase
{
    public function getEntity(): User
    {
        return (new User)
            ->setFullName('Jean Test')
            ->setEmail('jean.test@gmail.com')
            ->setRoles([])
            ->setGoogleId('123456688635466')
            ->setAvatar('https://testAvatar.fr');
    }

    public function assertHasErrors(User $user, int $number = 0)
    {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($user);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error){
            $messages[] = $error->getPropertyPath() . ' =>' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }


    public function testValidUser(): void
    {
        $user = $this->getEntity();
        $this->assertHasErrors($user, 0);
    }

    public function testBlankFullName()
    {
        $this->assertHasErrors($this->getEntity()->setFullName(''), 1);
    }
    public function testBlankEmail()
    {
        $this->assertHasErrors($this->getEntity()->setEmail(''), 1);
    }

    public function testBlankGoogleId()
    {
        $this->assertHasErrors($this->getEntity()->setGoogleId(''), 1);
    }

    public function testUniqueMail()
    {
        $this->assertHasErrors($this->getEntity()->setEmail('mtyas0@sohu.com', 1));
    }
}