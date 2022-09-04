<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\Invoice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Model\Invoice;
use App\Infrastructure\Symfony\Services\invoiceService;
use App\UI\InvoiceType;

class updateInvoiceController extends AbstractController
{
    public function update(Request $request, Invoice $invoice, invoiceService $service)
    {
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service->updateInvoice($form->getData());
            if ($service) {
                $this->addFlash('success', 'Facture mis à jour avec succés !');
            }
        }
        return $this->render('Invoice/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
