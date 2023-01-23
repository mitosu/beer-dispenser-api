<?php

namespace App\Tests\User;

use App\DispenserContext\Domain\Entity\User;
use App\DispenserContext\Infrastructure\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SaveUserTest extends KernelTestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->userRepository = static::getContainer()->get('App\Repository\UserRepository');
    }

    public function testSaveUser(): void
    {
        $user = new User('Miguel Torres', 'migueltorres@mail.com');
        
        $this->userRepository->save($user);
        $newUser = $this->userRepository->findUserByEmail($user->getMail());

        $this->assertEquals($user->getMail(), $newUser->getMail());
    }
}
