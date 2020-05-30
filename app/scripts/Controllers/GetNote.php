<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Exception\InternalServerException;
use App\Controllers\Exception\NotFoundException;
use App\DataMappers\Exception\DataMapperException;
use App\DataMappers\Exception\NotFoundDataMapperException;
use App\DataMappers\Exception\WrongClassDataMapperException;
use App\Services\Exception\NotFoundServiceException;
use App\Services\Exception\ServiceException;
use App\Services\Notes;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\ServerRequest;

class GetNote
{

    /** @var Notes */
    private Notes $notesService;

    /**
     * @param Notes $notesService
     */
    public function __construct(Notes $notesService)
    {
        $this->notesService = $notesService;
    }

    /**
     * @param ServerRequest $request
     * @param Response $response
     * @param int $id
     * @return Response
     * @throws InternalServerException
     * @throws NotFoundException
     */
    public function __invoke(ServerRequest $request, Response $response, int $id): Response
    {
        try {
            $data = $this->notesService->getById($id);
        } catch (NotFoundServiceException $e) {
            throw new NotFoundException($e->getMessage());
        } catch (ServiceException $e) {
            throw new InternalServerException($e->getMessage());
        }

        $response->getBody()->write((string)json_encode($data));
        return $response;
    }
}
