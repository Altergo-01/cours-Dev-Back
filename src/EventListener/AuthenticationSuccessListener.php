<?php
namespace App\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    /**

    @param AuthenticationSuccessEvent $event*/
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void{$data = $event->getData();$user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        // Create an associative array for user data
        $userData = [

            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'picture' => $user->getMediaObject()->getFilePath()
        ];

        // Add the userData array under the 'user' key
        $data['user'] = $userData;

        $event->setData($data);
    }
}