<?php

/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_Paymentfee
 * @copyright  Copyright (c) 2020 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */

namespace Lof\Paymentfee\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice;
use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class Fee extends AbstractTotal
{
    /**
     * @param Invoice $invoice
     * @return $this
     */
    public function collect(Invoice $invoice)
    {
        $invoice->setPaymentFee(0);
        $invoice->setBasePaymentFee(0);
        $invoice->setPaymentFeeTax(0);
        $invoice->setBasePaymentFeeTax(0);

        $order = $invoice->getOrder();

        if ($order->getInvoiceCollection()->getTotalCount()) {
            return $this;
        }

        $paymentFee = $order->getPaymentFee();
        $basePaymentFee = $order->getBasePaymentFee();
        $paymentFeeTax = $order->getPaymentFeeTax();
        $basePaymentFeeTax = $order->getBasePaymentFeeTax();

        if ($paymentFee != 0) {
            $invoice->setPaymentFee($paymentFee);
            $invoice->setBasePaymentFee($basePaymentFee);
            $invoice->setPaymentFeeTax($paymentFeeTax);
            $invoice->setBasePaymentFeeTax($basePaymentFeeTax);
            $invoice->setGrandTotal($invoice->getGrandTotal() + $paymentFee + $paymentFeeTax);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $basePaymentFee + $basePaymentFeeTax);
            $invoice->setTaxAmount($invoice->getTaxAmount() + $paymentFeeTax);
            $invoice->setBaseTaxAmount($invoice->getBaseTaxAmount() + $basePaymentFeeTax);
        }

        return $this;
    }
}
