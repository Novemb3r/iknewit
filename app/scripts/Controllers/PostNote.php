<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Exception\InternalServerException;
use App\Entities\Note;
use App\Services\Exception\ServiceException;
use App\Services\Notes;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\ServerRequest;

class PostNote extends ControllerAbstract
{

    /**
     * @var Notes
     */
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
     * @return Response
     * @throws InternalServerException
     */
    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $body = (array)$request->getParsedBody();

        $note = new Note();
        $note->setText($body['text']);

        try {
            $this->notesService->save($note);
        } catch (ServiceException $e) {
            throw new InternalServerException($e->getMessage());
        }

        $response->getBody()->write($this->getJsonResponse($note));
        return $response;
    }
}
