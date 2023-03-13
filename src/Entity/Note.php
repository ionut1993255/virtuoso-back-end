<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Song::class, inversedBy: 'id')]
    private Song $song;

    #[ORM\Column(length: 255)]
    private String $instrument;

    #[ORM\Column(length: 255)]
    private String $note;

    #[ORM\Column]
    private int $time;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of song
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * Set the value of song
     *
     * @return  self
     */
    public function setSong($song)
    {
        $this->song = $song;

        return $this;
    }

    /**
     * Get the value of instrument
     */
    public function getInstrument()
    {
        return $this->instrument;
    }

    /**
     * Set the value of instrument
     *
     * @return  self
     */
    public function setInstrument($instrument)
    {
        $this->instrument = $instrument;

        return $this;
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */
    public function setTime(int $time)
    {
        $this->time = $time;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'song' => $this->getSong(),
            'instrument' => $this->getInstrument(),
            'note' => $this->getNote(),
            'time' => $this->getTime()
        ];
    }
}
