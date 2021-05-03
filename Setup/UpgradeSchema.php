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

namespace Lof\Paymentfee\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.4', '<')) {
            $this->addPaymentFeeTaxColumns($setup);
        }
    }

    /**
     * Create payment fee tax columns
     * @param $setup
     */
    public function addPaymentFeeTaxColumns($setup)
    {
        $setup->startSetup();

        $quoteTable = 'quote';
        $quoteAddressTable = 'quote_address';
        $orderTable = 'sales_order';
        $invoiceTable = 'sales_invoice';
        $creditmemoTable = 'sales_creditmemo';

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'base_payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'base_payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'base_payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'base_payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee Tax'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'base_payment_fee_tax',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee Tax'
                ]
            );

        $setup->endSetup();
    }
}
