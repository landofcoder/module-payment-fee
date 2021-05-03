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

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->addPaymentFeeColumns($setup);
        $setup->endSetup();
    }

    /**
     * Add payment fee columns
     * @param SchemaSetupInterface $setup
     */
    public function addPaymentFeeColumns($setup)
    {
        $quoteTable = 'quote';
        $quoteAddressTable = 'quote_address';
        $orderTable = 'sales_order';
        $invoiceTable = 'sales_invoice';
        $creditmemoTable = 'sales_creditmemo';

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'base_payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'base_payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'base_payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'base_payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Payment Fee'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'base_payment_fee',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'nullable' => true,
                    'length' => '12,4',
                    'default' => '0.0000',
                    'comment' => 'Base Payment Fee'
                ]
            );
    }
}
