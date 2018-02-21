<?php

namespace Shift\ShiftBundle\Entity\Event;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventMetaData
 *
 * @ORM\Table(name="event_meta_data")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Event\EventMetaDataRepository")
 */
class EventMetaData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", length=25, unique=true)
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="event_object_type", type="string", length=25, nullable=true)
     */
    private $eventObjectType;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eventName
     *
     * @param string $eventName
     *
     * @return EventMetaData
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set eventObjectType
     *
     * @param string $eventObjectType
     *
     * @return EventMetaData
     */
    public function setEventObjectType($eventObjectType)
    {
        $this->eventObjectType = $eventObjectType;

        return $this;
    }

    /**
     * Get eventObjectType
     *
     * @return string
     */
    public function getEventObjectType()
    {
        return $this->eventObjectType;
    }
}

