<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartSubscriber implements EventSubscriberInterface
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    public function onKernelController(ControllerEvent $event): void
    {
        if (!$this->session->isStarted()) {
            $this->session->start();
        }

        $panier = $this->session->get('panier', []);
        $panierCount = 0;

        foreach ($panier as $item) {
            $panierCount += $item['quantity'] ?? 0;
        }

        $this->session->set('panier_count', $panierCount);
    }
}
