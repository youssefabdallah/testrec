<?php

namespace App\Infrastructure\Symfony\Controller\Invoice;

use App\Infrastructure\Symfony\Services\invoiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class getInvoiceController extends AbstractController
{
    /**
     * 
     * @param invoiceService $service
     * @return Response
     */
    public function getInvoices(invoiceService $service): Response
    {
        $invoices = $service->getInvoices();
        return $this->render('Invoice/list.html.twig', [
            'invoices' => $invoices
        ]);
    }
}
