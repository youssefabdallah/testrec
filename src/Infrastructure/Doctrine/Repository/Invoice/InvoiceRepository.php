<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository\Invoice;

use App\Application\Gateway\Repository\InvoiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Model\Invoice;
use App\Domain\Model\User;
use Doctrine\ORM\EntityNotFoundException;


class InvoiceRepository extends ServiceEntityRepository implements InvoiceRepositoryInterface
{


    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    /**
     * @inheritDoc
     * @param Invoice $object
     */
    public function save(Invoice $object): void
    {
        $this->_em->persist($object);
        $this->_em->flush();
    }

    /**
     * @inheritDoc
     * @param Invoice $invoice
     */
    public function update(Invoice $invoice)
    {
        if (!$invoice) {
            throw new EntityNotFoundException('Facture n\'existe pase');
        }
        $this->_em->flush();
        return true;
    }

    /**
     * @param string $id
     * @return void
     */
    public function remove(string $id): void
    {
        $invoice = $this->find($id);
        if ($invoice instanceof Invoice) {
            $this->_em->remove($invoice);
            $this->_em->flush();
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->findAll();
    }


    /**
     * @param string $id
     * @return Invoice|null
     */
    public function findById(string $id): ?Invoice
    {
        return $this->find($id);
    }

    /**
     * @param User $user
     * @return array
     */
    public function findByUser(User $user): array
    {
        return $this->findBy(['user' => $user]);
    }
}
