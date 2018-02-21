<?php

namespace Shift\ShiftBundle\Entity\Event;

use Doctrine\ORM\Mapping as ORM;

/**
 * FysEvents
 *
 * @ORM\Table(name="fys_events")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Event\FysEventsRepository")
 */
class FysEvents
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
     * @ORM\Column(name="event_name", type="string", length=25)
     */
    private $eventName;

    /**
     * @var int
     *
     * @ORM\Column(name="event_modified_object_id", type="integer")
     */
    private $eventModifiedObjectId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_object_type", type="string", length=25, nullable=true)
     */
    private $eventObjectType;

    /**
     * @var int
     *
     * @ORM\Column(name="event_created_by_id", type="integer")
     */
    private $eventCreatedById;

    /**
     * @var string
     *
     * @ORM\Column(name="event_created_by_name", type="string", length=50, nullable=true)
     */
    private $eventCreatedByName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_created_time", type="datetime")
     */
    private $eventCreatedTime;

    /**
     * @var int
     *
     * @ORM\Column(name="event_modified_object_owner_id", type="integer")
     */
    private $eventModifiedObjectOwnerId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_modified_object_owner_name", type="string", length=50)
     */
    private $eventModifiedObjectOwnerName;


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
     * @return FysEvents
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
     * Set eventModifiedObjectId
     *
     * @param integer $eventModifiedObjectId
     *
     * @return FysEvents
     */
    public function setEventModifiedObjectId($eventModifiedObjectId)
    {
        $this->eventModifiedObjectId = $eventModifiedObjectId;

        return $this;
    }

    /**
     * Get eventModifiedObjectId
     *
     * @return int
     */
    public function getEventModifiedObjectId()
    {
        return $this->eventModifiedObjectId;
    }

    /**
     * Set eventObjectType
     *
     * @param string $eventObjectType
     *
     * @return FysEvents
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

    /**
     * Set eventCreatedById
     *
     * @param integer $eventCreatedById
     *
     * @return FysEvents
     */
    public function setEventCreatedById($eventCreatedById)
    {
        $this->eventCreatedById = $eventCreatedById;

        return $this;
    }

    /**
     * Get eventCreatedById
     *
     * @return int
     */
    public function getEventCreatedById()
    {
        return $this->eventCreatedById;
    }

    /**
     * Set eventCreatedByName
     *
     * @param string $eventCreatedByName
     *
     * @return FysEvents
     */
    public function setEventCreatedByName($eventCreatedByName)
    {
        $this->eventCreatedByName = $eventCreatedByName;

        return $this;
    }

    /**
     * Get eventCreatedByName
     *
     * @return string
     */
    public function getEventCreatedByName()
    {
        return $this->eventCreatedByName;
    }

    /**
     * Set eventCreatedTime
     *
     * @param \DateTime $eventCreatedTime
     *
     * @return FysEvents
     */
    public function setEventCreatedTime($eventCreatedTime)
    {
        $this->eventCreatedTime = $eventCreatedTime;

        return $this;
    }

    /**
     * Get eventCreatedTime
     *
     * @return \DateTime
     */
    public function getEventCreatedTime()
    {
        return $this->eventCreatedTime;
    }

    /**
     * Set eventModifiedObjectOwnerId
     *
     * @param integer $eventModifiedObjectOwnerId
     *
     * @return FysEvents
     */
    public function setEventModifiedObjectOwnerId($eventModifiedObjectOwnerId)
    {
        $this->eventModifiedObjectOwnerId = $eventModifiedObjectOwnerId;

        return $this;
    }

    /**
     * Get eventModifiedObjectOwnerId
     *
     * @return int
     */
    public function getEventModifiedObjectOwnerId()
    {
        return $this->eventModifiedObjectOwnerId;
    }

    /**
     * Set eventModifiedObjectOwnerName
     *
     * @param string $eventModifiedObjectOwnerName
     *
     * @return FysEvents
     */
    public function setEventModifiedObjectOwnerName($eventModifiedObjectOwnerName)
    {
        $this->eventModifiedObjectOwnerName = $eventModifiedObjectOwnerName;

        return $this;
    }

    /**
     * Get eventModifiedObjectOwnerName
     *
     * @return string
     */
    public function getEventModifiedObjectOwnerName()
    {
        return $this->eventModifiedObjectOwnerName;
    }
}

