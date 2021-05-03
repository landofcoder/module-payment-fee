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

namespace Lof\Paymentfee\Block\Adminhtml\System\Form\Field;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\BlockInterface;
use Lof\Paymentfee\Model\Config\Source\ActiveMethods;

class PaymentFee extends AbstractFieldArray
{
    protected $_columns = [];

    /**
     * @var Methods
     */
    protected $_typeRenderer;

    protected $_searchFieldRenderer;

    /**
     * @var ActiveMethods
     */
    protected $activeMethods;

    /**
     * PaymentFee constructor.
     * @param Context $context
     * @param ActiveMethods $activeMethods
     * @param array $data
     */
    public function __construct(
        Context $context,
        ActiveMethods $activeMethods,
        array $data = []
    ) {
        $this->activeMethods = $activeMethods;
        parent::__construct($context, $data);
    }

    /**
     * Prepare to render
     * @throws LocalizedException
     */
    protected function _prepareToRender()
    {
        $this->_typeRenderer        = null;
        $this->_searchFieldRenderer = null;

        $this->addColumn(
            'payment_method',
            ['label' => __('Payment Method - Code'), 'renderer' => $this->_getPaymentRenderer()]
        );

        $this->addColumn('fee', ['label' => __('Fee Amount')]);
        $this->_addAfter       = false;
        $this->_addButtonLabel = __('Add Fee');
    }

    /**
     * @return BlockInterface|Methods
     * @throws LocalizedException
     */
    protected function _getPaymentRenderer()
    {
        if (!$this->_typeRenderer) {
            $this->_typeRenderer = $this->getLayout()->createBlock(
                Methods::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->_typeRenderer->setClass('paymentfee_select');
        }
        return $this->_typeRenderer;
    }

    /**
     * Prepare existing row data object
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row)
    {
        $optionExtraAttr = [];
        $optionExtraAttr['option_' . $this->_getPaymentRenderer()->calcOptionHash($row->getData('payment_method'))] =
            'selected="selected"';
        $row->setData(
            'option_extra_attrs',
            $optionExtraAttr
        );
    }
}
