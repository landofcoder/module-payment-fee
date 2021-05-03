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

namespace Lof\Paymentfee\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo;
use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;
use Lof\Paymentfee\Helper\Data;

class Fee extends AbstractTotal
{
    /**
     * @var Data
     */
    protected $paymentHelper;

    /**
     * Fee constructor.
     * @param Data $paymentHelper
     * @param array $data
     */
    public function __construct(
        Data $paymentHelper,
        array $data = []
    ) {
        parent::__construct($data);
        $this->paymentHelper = $paymentHelper;
    }

    /**
     * @param Creditmemo $creditmemo
     * @return $this
     */
    public function collect(Creditmemo $creditmemo)
    {
        $creditmemo->setPaymentFee(0);
        $creditmemo->setBasePaymentFee(0);
        $creditmemo->setPaymentFeeTax(0);
        $creditmemo->setBasePaymentFeeTax(0);

        $storeId = $creditmemo->getOrder()->getStoreId();
        if (!$this->paymentHelper->isRefund($storeId)) {
            return $this;
        }

        $order = $creditmemo->getOrder();
        $paymentFee = $order->getPaymentFee();
        $basePaymentFee = $order->getBasePaymentFee();
        $paymentFeeTax = $order->getPaymentFeeTax();
        $basePaymentFeeTax = $order->getBasePaymentFeeTax();

        if ($paymentFee != 0) {
            $creditmemo->setPaymentFee($paymentFee);
            $creditmemo->setBasePaymentFee($basePaymentFee);
            $creditmemo->setPaymentFeeTax($paymentFeeTax);
            $creditmemo->setBasePaymentFeeTax($basePaymentFeeTax);
            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $paymentFee);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $basePaymentFee);
            $creditmemo->setTaxAmount($creditmemo->getTaxAmount() + $paymentFeeTax);
            $creditmemo->setBaseTaxAmount($creditmemo->getBaseTaxAmount() + $basePaymentFeeTax);
        }

        return $this;
    }
}
