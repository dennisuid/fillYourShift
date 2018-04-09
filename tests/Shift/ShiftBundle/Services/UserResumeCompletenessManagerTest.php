<?php
/**
 * Created by PhpStorm.
 * User: riyadennis
 * Date: 05/04/2018
 * Time: 18:00
 */

namespace Tests\Shift\ShiftBundle\Services;


use Doctrine\ORM\EntityManager;
use Shift\ShiftBundle\Entity\User\FysEmployeeResume;
use Shift\ShiftBundle\Services\UserResumeCompletenessManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Mockery;

class UserResumeCompletenessManagerTest extends WebTestCase
{
    public function testManageResumeCompleteness()
    {
        $em = Mockery::mock(EntityManager::class);
        $employeeResume = Mockery::mock(FysEmployeeResume::class);
        $em->shouldReceive('merge');
        $em->shouldReceive('flush');
        $em->shouldReceive('getRepository')->andReturn($employeeResume);
        $employeeResume->shouldReceive('findByEmployeeId')->andReturn($employeeResume);
        $employeeResume->shouldReceive('getUserResumeCompleteness')->andReturn(0);
        $employeeResume->shouldReceive('setUserResumeCompleteness');
        $userResumeManager = new UserResumeCompletenessManager();
        $this->assertTrue($userResumeManager->manageResumeCompleteness($em, 2, 2));
    }
    public function testPercentageOnStepOne()
    {
        $userResumeManager = new UserResumeCompletenessManager();
        $this->assertEquals(10, $userResumeManager->calculateResumeCompleteness(0,1));
        $this->assertEquals(20, $userResumeManager->calculateResumeCompleteness(10,2));
        $this->assertEquals(60, $userResumeManager->calculateResumeCompleteness(20,3));
        $this->assertEquals(100, $userResumeManager->calculateResumeCompleteness(60,4));
        $this->assertEquals(100, $userResumeManager->calculateResumeCompleteness(100,4));
        $this->assertEquals(100, $userResumeManager->calculateResumeCompleteness(100,3));
    }
}
