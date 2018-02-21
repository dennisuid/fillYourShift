<?php

namespace Shift\ShiftBundle\Repository\Org;

use Doctrine\ORM\EntityRepository;
use Shift\ShiftBundle\Entity\Org\FysRole;

class FysRoleRepository extends EntityRepository
{
    public function getAllRoles()
    {
        $roles = [];
        /* @var $role FysRole */
        foreach ($this->findAll() as $role) {
            $roles[ucwords($role->getRoleName())] = $role->getRoleName();
        }
        return $roles;
    }

}
