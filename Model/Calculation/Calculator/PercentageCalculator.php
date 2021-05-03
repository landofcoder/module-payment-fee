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

namespace Lof\Paymentfee\Model\Calculation\Calculator;

use Magento\Quote\Model\Quote;

class PercentageCalculator extends AbstractCalculator
{
    /**
     * {@inheritdoc}
     */
    public function calculate(Quote $quote)
    {
        $fee = $this->helper->getFee($quote);
        
        $subTotal = $quote->getBaseSubtotal();

        if ($this->helper->getIsIncludeShipping()) {
            $subTotal += $quote->getShippingAddress()->getBaseShippingAmount();
        }

        if ($this->helper->getIsIncludeDiscount()) {
            $discount = 0;
            foreach ($quote->getAllItems() as $item) {
                $discount -= $item->getBaseDiscountAmount();
            }
            $subTotal += $discount;
        }
        
        return ($subTotal * $fee) / 100;
    }
}
