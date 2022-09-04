<?php

declare(strict_types=1);

namespace App\Application\Gateway\Repository;

use App\Domain\Model\Invoice;
use App\Domain\Model\User;

interface InvoiceRepositoryInterface
{
    /**
     * @param string $id
     */
    public function findById(string $id): ?Invoice;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Invoice $invoice
     */
    public function save(Invoice $invoice): void;

    /**
     * @param string $id
     */
    public function remove(string $id): void;

    /**
     * @param User $user
     */
    public function findByUser(User $user): array;
}
