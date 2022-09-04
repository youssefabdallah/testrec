<?php

declare(strict_types=1);

namespace App\Infrastructure\Events\Invoice;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Security;
use App\Domain\Model\Invoice;
use App\Infrastructure\Helper\tvaHelper;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;

class InvoiceSubscriber implements EventSubscriber
{

    /**
     * @var Security
     */
    private $security;

    /**
     * @var tvaHelper
     */
    private $tvaHelper;

    public function __construct(Security $security, tvaHelper $tvaHelper)
    {
        $this->security = $security;
        $this->tvaHelper = $tvaHelper;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            Events::preUpdate,
            Events::prePersist
        ];
    }


    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Invoice) {
            $ttc = $this->tvaHelper->calculateTTC($entity->getPriceHt());
            $entity->setPriceTtc($ttc);
            $entity->setUser($this->security->getUser());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Invoice) {
            if ($entity->getUser() != $this->security->getUser()) {
                throw new AccessDeniedException('Vous n\'etes pas autorisé à modifier cette facture !');
            }
            $ttc = $this->tvaHelper->calculateTTC($entity->getPriceHt());
            $entity->setPriceTtc($ttc);
        }
    }
}
