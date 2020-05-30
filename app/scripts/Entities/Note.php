<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * @Entity
 * @Table(name="notes")
 **/
class Note implements \JsonSerializable
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
     * @return array<int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text
        ];
    }
}
