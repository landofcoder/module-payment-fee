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

namespace Lof\Paymentfee\Model\Calculation;

use Magento\Framework\Exception\ConfigurationMismatchException;
use Magento\Framework\ObjectManagerInterface;
use Lof\Paymentfee\Helper\Data as FeeHelper;
use Lof\Paymentfee\Model\Config\Source\PriceType;

class CalculatorFactory
{
    /**
     * @var FeeHelper
     */
    protected $helper;

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * CalculationFactory constructor.
     *
     * @param ObjectManagerInterface $objectManager
     * @param FeeHelper $helper
     */
    public function __construct(ObjectManagerInterface $objectManager, FeeHelper $helper)
    {
        $this->helper = $helper;
        $this->objectManager = $objectManager;
    }

    /**
     * @return Calculator\CalculatorInterface
     * @throws ConfigurationMismatchException
     */
    public function get()
    {
        switch ($this->helper->getPriceType()) {
            case PriceType::TYPE_FIXED:
                return $this->objectManager->get(Calculator\FixedCalculator::class);
            case PriceType::TYPE_PERCENTAGE:
                return $this->objectManager->get(Calculator\PercentageCalculator::class);
            case PriceType::TYPE_PER_ROW:
                return $this->objectManager->get(Calculator\PerRowCalculator::class);
            case PriceType::TYPE_PER_ITEM:
                return $this->objectManager->get(Calculator\PerItemCalculator::class);
            default:
                throw new ConfigurationMismatchException(
                    __('Could not find price calculator for type %1', $this->helper->getPriceType())
                );
        }
    }
}
