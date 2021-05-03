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

namespace Lof\Paymentfee\Model\Pdf;

use Magento\Sales\Model\Order\Pdf\Total\DefaultTotal;
use Magento\Tax\Helper\Data;
use Magento\Tax\Model\Calculation;
use Magento\Tax\Model\ResourceModel\Sales\Order\Tax\CollectionFactory;
use Lof\Paymentfee\Helper\Data as FeeHelper;

class Fee extends DefaultTotal
{
    /**
     * @var FeeHelper
     */
    protected $helper;

    /**
     * Fee constructor.
     * @param Data $taxHelper
     * @param Calculation $taxCalculation
     * @param CollectionFactory $ordersFactory
     * @param FeeHelper $helper
     * @param array $data
     */
    public function __construct(
        Data $taxHelper,
        Calculation $taxCalculation,
        CollectionFactory $ordersFactory,
        FeeHelper $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct(
            $taxHelper,
            $taxCalculation,
            $ordersFactory,
            $data
        );
    }

    /**
     * Add payment fee totals in sales PDF
     * @return array
     */
    public function getTotalsForDisplay()
    {
        $totals = [];
        $paymentFee = $this->getSource()->getPaymentFee();
        if ($paymentFee != 0) {
            $paymentFeeTax = $this->getSource()->getPaymentFeeTax();
            $amount = $this->getOrder()->formatPriceTxt($paymentFee);
            $amountInclTax = $this->getOrder()->formatPriceTxt($paymentFee + $paymentFeeTax);
            $defaultLabel = $this->helper->getTitle();
            $fontSize = $this->getFontSize() ? $this->getFontSize() : 7;

            if ($this->helper->displayExclTax()) {
                $label = $defaultLabel;
                if ($this->helper->displaySuffix()) {
                    $label .= ' ' . __('(Excl. Tax)');
                }
                $totals[] = [
                    'amount' => $this->getAmountPrefix() . $amount,
                    'label' => $label . ':',
                    'font_size' => $fontSize
                ];
            }

            if ($this->helper->displayInclTax()) {
                $label = $defaultLabel;
                if ($this->helper->displaySuffix()) {
                    $label .= ' ' . __('(Incl. Tax)');
                }
                $totals[] = [
                    'amount' => $this->getAmountPrefix() . $amountInclTax,
                    'label' => $label . ':',
                    'font_size' => $fontSize
                ];
            }
        }

        return $totals;
    }
}
