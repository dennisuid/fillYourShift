<?php

namespace Tests\Shift\ShiftBundle\Entity\User;

use Shift\ShiftBundle\Entity\User\FysUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\Tools\SchemaTool;

class FysUserTest extends WebTestCase
{

    protected function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $this->_container = $kernel->getContainer();
        $this->_em = $this->_container->get('doctrine')->getManager();
        $schemaTool = new SchemaTool($this->_em);
        $metadata = $this->_em->getMetadataFactory()->getAllMetadata();
        // Drop and recreate tables for all entities
        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }

    public function testFysUserReturnsCorrectObject()
    {
        $fysUser = new FysUser();
        $this->assertInstanceOf(FysUser::class, $fysUser);
        $this->assertNotEmpty($fysUser->getRoles());
    }

    public function testFysUserCanSetRoles()
    {
        $fysUser = new FysUser();
        $roles = [
            "employee",
            "employer",
        ];
        $fysUser->setRoles($roles);
        $this->assertCount(3, $fysUser->getRoles());

        $role = "employee";
        $this->assertTrue($fysUser->hasRole($role));
    }

    public function testFysUserSaveAddsRoles()
    {
        $fysUser = new FysUser();
        $role = "employee";
        $fysUser->setRoles([$role]);
        $fysUser->setEmail("testemail@test.com");
        $fysUser->setFirstName("Richard");
        $fysUser->setLastName("Knopp");
        $fysUser->setUsername("richard123");
        $fysUser->setPassword("test");
        $fysUser->setMobileNumber("344555");
        $fysUser->setUserType("employee");
        $fysUser->setPostcode("33454");
        $fysUser->setCountry("UK");
        $fysUser->setRegistrationNumber(343543);

        $this->_em->persist($fysUser);
        $this->_em->flush();

        $fysUserFromDB = $this->_container
                        ->get('doctrine')
                        ->getRepository('ShiftBundle:User\FysUser')->find(1);
        $this->assertTrue($fysUserFromDB->hasRole($role));
    }

}
