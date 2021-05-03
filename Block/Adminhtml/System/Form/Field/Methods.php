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

use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;
use Magento\Payment\Model\Config as PaymentModelConfig;
use Magento\Payment\Model\Method\Factory as PaymentMethodFactory;
use Magento\Store\Model\ScopeInterface;

class Methods extends Select
{
    /**
     * Payment methods cache
     *
     * @var array
     */
    protected $methods;

    /**
     * @var PaymentModelConfig
     */
    protected $paymentConfig;

    /**
     * @var PaymentMethodFactory
     */
    protected $paymentMethodFactory;

    /**
     * Methods constructor.
     * @param Context $context
     * @param PaymentModelConfig $config
     * @param PaymentMethodFactory $paymentMethodFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PaymentModelConfig $config,
        PaymentMethodFactory $paymentMethodFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->paymentConfig = $config;
        $this->paymentMethodFactory = $paymentMethodFactory;
    }

    protected function _getPaymentMethods()
    {
        if ($this->methods === null) {
            $methods = [];
            foreach ($this->_scopeConfig->getValue('payment', ScopeInterface::SCOPE_STORE, null) as $code => $data) {
                if (isset($data['title'])) {
                    $methods[$code] = $data['title'];
                }
            }
            $this->methods = $methods;
        }
        return $this->methods;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
            foreach ($this->_getPaymentMethods() as $paymentCode => $paymentTitle) {
                $paymentTitle = $paymentTitle . ' - ' . $paymentCode;
                $this->addOption($paymentCode, addslashes($paymentTitle));
            }
        }
        return parent::_toHtml();
    }
}
