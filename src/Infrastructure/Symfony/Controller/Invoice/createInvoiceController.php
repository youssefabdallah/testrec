<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller\Invoice;

use App\Domain\Model\Invoice;
use App\Infrastructure\Symfony\Factory\Invoice\InvoiceFactory;
use App\Infrastructure\Symfony\Services\invoiceService;
use App\UI\InvoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class createInvoiceController extends AbstractController
{
    public function create(Request $request, invoiceService $invoiceService)
    {
        $form = $this->createForm(InvoiceType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $invoice = $invoiceService->createInvoice($form->getData());
            if ($invoice) {
                return $this->redirectToRoute('invoice_list');
            }
        }
        return $this->render('Invoice/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
