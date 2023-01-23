<?php

declare(strict_types=1);

namespace App\DispenserContext\Domain\Entity\ValueObjects\Id;

class GenerateId
{
    private string $id;

    public function __construct()
    {
        $this->id = self::uidv4();
    }

    public function value(): string
    {
        return $this->id;
    }

    /**
     * Summary of uidv4
     * @param mixed $data
     * @return string
     */
    private static function uidv4($data = null): string
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}