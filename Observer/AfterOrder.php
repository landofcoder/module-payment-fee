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

namespace Lof\Paymentfee\Observer;

use Magento\Framework\Event\ObserverInterface;

class AfterOrder implements ObserverInterface
{
    /**
     * Set payment fee to order
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $paymentFee = $quote->getPaymentFee();
        $basePaymentFee = $quote->getBasePaymentFee();
        if (!$paymentFee || !$basePaymentFee) {
            return $this;
        }

        $paymentFeeTax = $quote->getPaymentFeeTax();
        $basePaymentFeeTax = $quote->getBasePaymentFeeTax();
        $order = $observer->getOrder();
        $order->setData('payment_fee', $paymentFee);
        $order->setData('base_payment_fee', $basePaymentFee);
        $order->setData('payment_fee_tax', $paymentFeeTax);
        $order->setData('base_payment_fee_tax', $basePaymentFeeTax);

        return $this;
    }
}
