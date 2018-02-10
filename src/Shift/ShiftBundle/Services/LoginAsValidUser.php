<?php

namespace Shift\ShiftBundle\Services;

use Shift\ShiftBundle\Entity\User\FysUser;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginAsValidUser
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function loginAsValidUser(FysUser $user, Request $request)
    {
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        try {
            // If the firewall name is not main, then the set value would be instead:
            // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
            $this->container->get('session')->set('_security_main', serialize($token));

            // Fire the login event manually
            $event = new InteractiveLoginEvent($request, $token);
            $this->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            $this->container->get('security.token_storage')->setToken($token);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}