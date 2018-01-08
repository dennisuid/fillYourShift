<?php

namespace Shift\ShiftBundle\Repository;

use Shift\ShiftBundle\Entity\Org\FysRole;

class FysRoleRepository extends \Doctrine\ORM\EntityRepository
{

    public function getAllRoles()
    {
        $roles = [];
        /* @var $role FysRole */
        foreach ($this->findAll() as $role) {
            $roles[ucwords($role->getRoleName())] = $role->getId();
        }
        return $roles;
    }

}
