<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Exception\InternalServerException;
use JsonException;
use JsonSerializable;

abstract class ControllerAbstract
{

    /**
     * @param JsonSerializable $data
     * @return string
     * @throws InternalServerException
     */
    protected function getJsonResponse(JsonSerializable $data): string
    {
        try {
            $data = json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new InternalServerException($e->getMessage());
        }

        return $data;
    }
}
