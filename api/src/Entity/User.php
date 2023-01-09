<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObjects\User\UserId;
use App\Entity\ValueObjects\User\UserName;
use App\Entity\ValueObjects\User\UserEmail;
use App\Entity\ValueObjects\User\UserToken;
use App\Entity\ValueObjects\User\UserPassword;
use App\Entity\ValueObjects\User\UserResetPasswordToken;
use App\Entity\ValueObjects\User\UserActive;
use App\Entity\ValueObjects\User\UserCreatedAt;
use App\Entity\ValueObjects\User\UserUpdatedAt;
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
        $userId = new UserId();
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

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
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

    public function active(): bool
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

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}