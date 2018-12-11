<?php
/**
 * Created by PhpStorm.
 * User: fedi
 * Date: 05/12/2018
 * Time: 16:37
 */

namespace AppBundle\EventListener;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface
{
public static function getSubscribedEvents()
{
    return array(
      FOSUserEvents::REGISTRATION_SUCCESS=>'onRegistrationSuccess'
    );

}
public function onRegistrationSuccess(FormEvent $event)
{


}
}