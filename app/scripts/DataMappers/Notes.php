<?php

declare(strict_types=1);

namespace App\DataMappers;

use App\DataMappers\Exception\DataMapperException;
use App\DataMappers\Exception\NotFoundDataMapperException;
use App\DataMappers\Exception\WrongClassDataMapperException;
use App\DataSource\Doctrine;
use App\Entities\Note;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;

class Notes
{
    /**
     * @var Doctrine
     */
    private Doctrine $db;

    /**
     * @param Doctrine $db
     */
    public function __construct(Doctrine $db)
    {
        $this->db = $db;
    }

    /**
     * @param int $id
     * @return Note
     * @throws DataMapperException
     * @throws NotFoundDataMapperException
     * @throws WrongClassDataMapperException
     */
    public function getById(int $id): Note
    {
        try {
            $note = $this->db->entityManager->find(Note::class, $id);
        } catch (OptimisticLockException | TransactionRequiredException | ORMException  $e) {
            throw new DataMapperException($e->getMessage(), $e->getCode(), $e);
        }

        if ($note === null) {
            throw new NotFoundDataMapperException(
                sprintf('Note with id %s not found', $id)
            );
        }

        if (!$note instanceof Note) {
            throw new WrongClassDataMapperException(
                'Retrieved object in not a Note'
            );
        }

        return $note;
    }

    /**
     * @param Note $note
     * @return void
     * @throws DataMapperException
     */
    public function save(Note $note): void
    {
        try {
            $this->db->entityManager->persist($note);
            $this->db->entityManager->flush();
        } catch (ORMException  $e) {
            throw new DataMapperException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
