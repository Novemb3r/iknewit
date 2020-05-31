<?php

declare(strict_types=1);

namespace App\Entities;

use DateTime;
use JsonSerializable;

/**
 * @Entity
 * @Table(name="notes")
 **/
class Note implements JsonSerializable
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private int $id;

    /**
     * @Column(name="text", type="string")
     * @var string
     */
    private string $text;

    /**
     * @Column(name="created_at", type="datetime")
     * @var DateTime
     */
    private DateTime $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return array<int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s')
        ];
    }
}
