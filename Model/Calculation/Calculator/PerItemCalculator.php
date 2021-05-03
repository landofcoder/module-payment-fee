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

class PerItemCalculator extends AbstractCalculator
{
    /**
     * {@inheritdoc}
     */
    public function calculate(Quote $quote)
    {
        $fee = $this->helper->getFee($quote);
        return $fee * $quote->getItemsQty();
    }
}
