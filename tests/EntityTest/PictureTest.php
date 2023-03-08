<?php
namespace App\Tests\EntityTest;

use App\Entity\Picture;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class PictureTest extends KernelTestCase
{
    public function getEntity(): Picture
    {
        return (new Picture)
            ->setTitle('Test de titre')
            ->setExplanation('Ceci est le test de la description')
            ->setImage('https://testimage.fr');
    }

    public function assertHasErrors(Picture $picture, int $number = 0)
    {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($picture);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach ($errors as $error){
            $messages[] = $error->getPropertyPath() . ' =>' . $error->getMessage();
        }
        $this->assertCount($number, $errors, implode(', ', $messages));
    }


    public function testValidPicture(): void
    {
        $picture = $this->getEntity();
        $this->assertHasErrors($picture, 0);
    }

    public function testBlankTitlePicture()
    {
        $this->assertHasErrors($this->getEntity()->setTitle(''), 1);
    }

    public function testBlankExplanation()
    {
        $this->assertHasErrors($this->getEntity()->setExplanation(''), 1);
    }
    public function testBlankImage()
    {
        $this->assertHasErrors($this->getEntity()->setImage(''), 1);
    }
    public function testBlankDate()
    {
        $this->assertHasErrors($this->getEntity()->setDate(new DateTime('')), 1);
    }
}