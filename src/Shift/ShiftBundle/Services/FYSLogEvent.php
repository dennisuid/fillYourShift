<?php

namespace Shift\ShiftBundle\Services;

use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;
use Shift\ShiftBundle\Entity\User\FysUser;
use Shift\ShiftBundle\Entity\Shift\Shift;
use Shift\ShiftBundle\Entity\Event\FysEvents;

class FYSLogEvent
{
    private $container;
    private $em;

    public function __construct(Container $container, EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    public function genericEvent(string $eventName, string $eventType, FysUser $currentUser, Shift $shift = null)
    {
        $event = new FysEvents();
        
        //$createdByUser = $this->container->get('security.token_storage')->getToken->getUser();
        //var_dump($createdByUser);
        $event->setEventCreatedById($currentUser->getId());
        $event->setEventCreatedByName($currentUser->getUserName());
        if($eventType == 'USER' && !empty($currentUser)){
        
            $event->setEventModifiedObjectId($currentUser->getId()); //modified object ID, in this case 'shift'
            $event->setEventModifiedObjectOwnerId($currentUser->getId()); // object owner
            $event->setEventModifiedObjectOwnerName($currentUser->getUsername()); // object owner name
        }
        if(!empty($shift) && $eventType == 'SHIFT'){
            $event->setEventModifiedObjectId($shift->getId()); //modified object ID, in this case 'shift'
            $event->setEventModifiedObjectOwnerId($shift->getShiftCreatedById()); // object owner
            $event->setEventModifiedObjectOwnerName($shift->getShiftCreatedBy()); // object owner name
        }
        $event->setEventName($eventName);
        $event->setEventObjectType($eventType);
        
        
        try {
            
            $this->em->persist($event);
            $this->em->flush();
            
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}