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
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private ?UserPassword $password;
    private ?UserToken $token;
    private ?UserResetPasswordToken $resetPasswordToken;
    private UserActive $active;
    private UserCreatedAt $createdAt;
    private DateTime $updatedAt;
    
    public function __construct(string $name, string $email)
    {
        $this->id = new UserId();
        $this->name = new UserName($name);
        $this->email = new UserEmail($email);
        $this->password = null;
        $this->token = new UserToken();
        $this->resetPasswordToken = null;
        $this->active = new UserActive();
        $this->createdAt = new UserCreatedAt();
        $this->updatedAt = $this->updatedAt();
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function email(): string
    {
        return $this->email->value();
    }

    public function password(): string
    {
        return $this->password->value();
    }

	public function token(): ?string
    {
		return $this->token->value();
	}

    public function resetPasswordToken(): string
    {
        return $this->resetPasswordToken->value();
    }

    public function active(): bool
    {
        return $this->active->value();
    }

	public function createdAt(): DateTime 
    {
		return $this->createdAt->value();
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

    public static function create(string $name, string $email) 
    {
        $user = new self($name, $email);
        return $user;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getSalt(): string|null
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->email->value();
    }

    public function eraseCredentials(): void
    {
        //
    }

    public function getPassword(): string|null
    {
        return null;
    }

    public function getUserIdentifier(): string
    {
        return $this->email->value();
    }
}