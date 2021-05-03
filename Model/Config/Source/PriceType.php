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

namespace Lof\Paymentfee\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class PriceType implements ArrayInterface
{
    /**
     * Price type variants
     */
    const TYPE_FIXED = 0;
    const TYPE_PERCENTAGE = 1;
    const TYPE_PER_ROW = 2;
    const TYPE_PER_ITEM = 3;

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::TYPE_PERCENTAGE => __('Percentage Price'),
            self::TYPE_FIXED => __('Fixed Price'),
            self::TYPE_PER_ROW => __('Per row'),
            self::TYPE_PER_ITEM => __('Per item')
        ];
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $optionArray = [];
        $arr = $this->toArray();
        foreach ($arr as $value => $label) {
            $optionArray[] = [
                'value' => $value,
                'label' => $label
            ];
        }
        return $optionArray;
    }
}
