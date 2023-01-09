<?php

declare(strict_types=1);

namespace App\Services\Request;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
class RequestService
{
    /**
     * Summary of getField
     * @param Request $request
     * @param string $field
     * @param bool $required
     * @param bool $isArray
     * @throws BadRequestException
     * @return mixed
     */
    public static function getField(Request $request, string $field, bool $required = true, bool $isArray = false)
    {
        $data = json_decode($request->getContent(), true);
        if ($isArray) {
            $data = self::arrayFlatten($data);

            foreach ($data as $key => $value) {
                if ($field === $key) {
                    return $value;
                }
            }

            if ($required) {
                throw new BadRequestException(sprintf('Missing field %s', $field));
            }

            return null;
        }

        if (array_key_exists($field, $data)) {
            return $data[$field];
        }

        if ($required) {
            throw new BadRequestException(sprintf('Missing field %s', $field));
        }

        return null;
    }

    public static function arrayFlatten(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::arrayFlatten($value));
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

}