<?php

/**
 * Oggetto Web extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Assist module to newer versions in the future.
 * If you wish to customize the Oggetto Assist module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Oggetto
 * @package   Oggetto_Assist
 * @copyright Copyright (C) 2012 Oggetto Web ltd (http://oggettoweb.com/)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Redirect form block
 *
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @subpackage Block
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Assist_Block_Redirect extends Mage_Core_Block_Abstract
{
    private $_anew = false;

    /**
     * Render form
     *
     * @return void
     */
    protected function _toHtml()
    {
        $gatewayassist = Mage::getModel('assist/payment');
        $fields = $gatewayassist->getAssistCheckoutFormFields($this->_anew);
        $form = new Varien_Data_Form();

        foreach ($fields as $field => $value) {
            $form->addField($field, 'hidden', array('name' => $field, 'value' => $value));
        }

        if (count($fields) > 1) {
            $redirectUrl = $gatewayassist->getAssistUrl();
        } else {
            $redirectUrl = $gatewayassist->getAssistUrlReturnNo();
        }

        $form->setAction($redirectUrl)
            ->setId('pay')
            ->setName('pay')
            ->setEnctype(Zend_Form::ENCTYPE_MULTIPART)
            ->setMethod(Zend_Form::METHOD_POST)
            ->setUseContainer(true);

        $html = '<html><body>';
        $html .= iconv('UTF-8', WP_GatewayAssist_Model_Checkout::ASSIST_POST_CHARSET,
            $this->__('You will be redirected to Assist in a few seconds.'));
        $html .= '<br />';
        $html .= $form->toHtml();
        $html .= '<br />';
        $html .= '<script type="text/javascript">document.getElementById("pay").submit();</script>';
        $html .= '</body></html>';

        return $html;
    }

    /**
     * Set anew parameter
     *
     * @param bool $value value
     *
     * @return Oggetto_Assist_Block_Redirect
     */
    public function setAnew($value)
    {
        $this->_anew = $value;
        return $this;
    }
}
