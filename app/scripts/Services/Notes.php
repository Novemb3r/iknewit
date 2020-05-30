<?php

declare(strict_types=1);

namespace App\Services;

use App\DataMappers\Exception\DataMapperException;
use App\DataMappers\Exception\NotFoundDataMapperException;
use App\DataMappers\Exception\WrongClassDataMapperException;
use App\DataMappers\Notes as NotesDataMapper;
use App\Entities\Note;
use App\Services\Exception\NotFoundServiceException;
use App\Services\Exception\ServiceException;

class Notes
{
    /**
     * @var NotesDataMapper
     */
    private NotesDataMapper $notes;

    /**
     * @param NotesDataMapper $cats
     */
    public function __construct(NotesDataMapper $cats)
    {
        $this->notes = $cats;
    }

    /**
     * @param int $id
     * @return Note
     * @throws NotFoundServiceException
     * @throws ServiceException
     */
    public function getById(int $id): Note
    {
        try {
            return $this->notes->getById($id);
        } catch (DataMapperException | WrongClassDataMapperException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        } catch (NotFoundDataMapperException $e) {
            throw new NotFoundServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param Note $note
     * @throws ServiceException
     */
    public function save(Note $note): void
    {
        try {
            $this->notes->save($note);
        } catch (DataMapperException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
