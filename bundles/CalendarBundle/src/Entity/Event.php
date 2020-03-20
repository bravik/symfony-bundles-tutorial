<?php

namespace bravik\CalendarBundle\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var DateTime
     */
    private $startsAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var DateTime|null
     */
    private $endsAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $venueAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $venueName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archived;


    public function __construct()
    {
        $this->archived = false;
        $this->startsAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartsAt(): DateTimeInterface
    {
        return $this->startsAt;
    }

    public function setStartsAt(DateTimeInterface $startsAt): self
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    public function getEndsAt(): ?DateTimeInterface
    {
        return $this->endsAt;
    }

    public function setEndsAt(?DateTimeInterface $endsAt): self
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVenueAddress()
    {
        return $this->venueAddress;
    }

    /**
     * @param mixed $venueAddress
     * @return static
     */
    public function setVenueAddress($venueAddress): self
    {
        $this->venueAddress = $venueAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVenueName()
    {
        return $this->venueName;
    }

    /**
     * @param mixed $venueName
     * @return static
     */
    public function setVenueName($venueName): self
    {
        $this->venueName = $venueName;
        return $this;
    }

    public function isArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
