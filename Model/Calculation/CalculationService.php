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
use Magento\Quote\Model\Quote;
use Lof\Paymentfee\Helper\Data as FeeHelper;
use Lof\Paymentfee\Model\Calculation\Calculator\CalculatorInterface;
use Psr\Log\LoggerInterface;

class CalculationService implements CalculatorInterface
{
    /**
     * @var CalculatorFactory
     */
    protected $factory;

    /**
     * @var FeeHelper
     */
    protected $helper;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * CalculationService constructor.
     * @param CalculatorFactory $factory
     * @param FeeHelper $helper
     * @param LoggerInterface $logger
     */
    public function __construct(CalculatorFactory $factory, FeeHelper $helper, LoggerInterface $logger)
    {
        $this->factory = $factory;
        $this->helper = $helper;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function calculate(Quote $quote)
    {
        if (!$this->helper->isEnable()) {
            return 0;
        }

        if (!$this->helper->canApply($quote)) {
            return 0;
        }

        if (!$this->hasMinOrderTotal($quote)) {
            return 0;
        }

        if ($this->hasMaxOrderTotal($quote)) {
            return 0;
        }

        if (!$this->isAllowCustomerGroup($quote)) {
            return 0;
        }

        try {
            return $this->factory->get()->calculate($quote);
        } catch (ConfigurationMismatchException $e) {
            $this->logger->error($e);
            return 0.0;
        }
    }

    /**
     * Check is order has minimum order total
     * @param Quote $quote
     * @return bool
     */
    private function hasMinOrderTotal(Quote $quote)
    {
        $amount = $quote->getBaseSubtotal();
        return $this->helper->getMinOrderTotal() <= $amount ? true: false;
    }

    /**
     * Check is order has maximum order total
     * @param Quote $quote
     * @return bool
     */
    private function hasMaxOrderTotal(Quote $quote)
    {
        $amount = $quote->getBaseSubtotal();
        return $this->helper->getMaxOrderTotal() <= $amount ? true: false;
    }

    /**
     * Check is customer group allowed
     * @param Quote $quote
     * @return bool
     */
    public function isAllowCustomerGroup(Quote $quote)
    {
        $customerGroups = $quote->getCustomerGroupId();
        $selectedCustomers = $this->helper->getCustomerGroup();
        if (in_array($customerGroups, $selectedCustomers)) {
            return true;
        }
    }
}
