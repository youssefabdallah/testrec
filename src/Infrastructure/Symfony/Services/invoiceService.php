<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Services;

use App\Domain\Model\Invoice;
use App\Infrastructure\Doctrine\Repository\Invoice\InvoiceRepository;
use Symfony\Component\Security\Core\Security;


class invoiceService
{

    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    /**
     * @var Security
     */
    private $security;


    public function __construct(InvoiceRepository $invoiceRepository, Security $security)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->security = $security;
    }

    public function createInvoice(object $data)
    {
        if ($data instanceof Invoice) {
            $this->invoiceRepository->save($data);
            return true;
        }
    }

    public function updateInvoice(object $data)
    {
        if ($data instanceof Invoice) {
            $this->invoiceRepository->update($data);
        }
    }

    /**
     *@return array
     */
    public function getInvoices(): ?array
    {
        $result = $this->invoiceRepository->findByUser($this->security->getUser());
        if ($result) {
            return $result;
        }
        return [];
    }
}
