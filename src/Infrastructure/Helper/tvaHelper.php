<?php

namespace App\Infrastructure\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;

class tvaHelper
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function calculateTTC(float $price_ht): float
    {
        $tva = $this->container->getParameter('TVA');
        $ttc = $price_ht + ($price_ht * 20 / 100);
        return $ttc;
    }
}
