<?php

namespace App\Tests\Services\Request;

use PHPUnit\Framework\TestCase;
use App\Services\Request\RequestService;
use Symfony\Component\HttpFoundation\Request;

class RequestServiceTest extends TestCase
{
    public function testFlattenArray(): void
    {
        $data = [
            'name' => 'Miguel Angel',
            'email' => 'miguelangel@gmail.com',
            'roles' => [
                'user:admin'
            ]
        ];

        $dataFlatten = RequestService::arrayFlatten($data);
        $this->assertTrue(in_array('user:admin', $dataFlatten));
    }
}
