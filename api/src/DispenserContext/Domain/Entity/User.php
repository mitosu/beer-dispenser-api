<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity;

use App\DispenserContext\Domain\Entity\ValueObjects\Id\GenerateId;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserName;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserEmail;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserToken;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserPassword;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserResetPasswordToken;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserActive;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserCreatedAt;
use App\DispenserContext\Domain\Entity\ValueObjects\User\UserUpdatedAt;
use DateTime;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    private string $id;
    private string $name;
    private string $email;
    private ?string $password;
    private ?string $token;
    private ?string $resetPasswordToken;
    private bool $active;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    
    public function __construct(string $name, string $email)
    {
        $userId = new GenerateId();
        $userName = new UserName($name);
        $userEmail = new UserEmail($email);
        $userActive = new UserActive();
        $userCreatedAt = new UserCreatedAt();
        $userToken = new UserToken();
        $userResetPasswordToken = new UserResetPasswordToken();

        $this->id = $userId->value();
        $this->name = $userName->value();
        $this->email = $userEmail->value();
        $this->password = null;
        $this->token = $userToken->value();
        $this->resetPasswordToken = $userResetPasswordToken->value();
        $this->active = $userActive->value();
        $this->createdAt = $userCreatedAt->value();
        $this->updatedAt = $this->updatedAt();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

	public function token(): ?string
    {
		return $this->token;
	}

    public function resetPasswordToken(): string
    {
        return $this->resetPasswordToken;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

	public function createdAt(): DateTime 
    {
		return $this->createdAt;
	}

	public function getUpdatedAt(): DateTime 
    {
		return $this->updatedAt;
	}

    public function updatedAt(): DateTime
    {
        $updatedAt =  new UserUpdatedAt();
        return $updatedAt->value();
    }

    public function getRoles(): array
    {
        return [];
    }

    /**
     * Summary of getSalt
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        //
    }

    /**
     * Summary of getPassword
     * @return null|string
     */
    public function getPassword()
    {
        return null;
    }

    public function setPassword(?string $password): void
    {
        $password = new UserPassword($password);
        $this->password = $password->value();
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}