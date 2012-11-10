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
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @copyright  Copyright (C) 2012 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Assist payment method model
 *
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @subpackage Model
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Assist_Model_Payment extends Mage_Payment_Model_Method_Abstract
{
    const ASSIST_URL             = 'https://payments.paysecure.ru/pay/order.cfm';
    const ASSIST_URL_DEBUG       = 'https://payments.paysecure.ru/pay/order.cfm';

    const ASSIST_CANCEL_URL      = 'https://payments.paysecure.ru/cancel/cancel.cfm';
    const ASSIST_POST_CHARSET    = 'UTF-8';

    const SELLER_REJECTION       = 1;
    const CUSTOMER_REJECTION     = 2;

    const ASSIST_RESPONSE_FORMAT_XML = '3';

    protected $_code                   = 'assist';
    protected $_formBlockType          = 'assist/form';
    protected $_infoBlockType          = 'assist/info';
    protected $_canUseForMultishipping = false;
    protected $_canAuthorize           = true;
    protected $_canRefund              = true;
    protected $_canVoid                = true;
    protected $_isGateway              = true;

    public $assistLanguageCode = array(
        'ru' => 'RU',
        'en' => 'EN',
    );

    public $assistCurrencyCode = array(
        'AUD' => 'AUD',
        'BYR' => 'BYR',
        'DKK' => 'DKK',
        'USD' => 'USD',
        'EUR' => 'EUR',
        'ISK' => 'ISK',
        'KZT' => 'KZT',
        'CAD' => 'CAD',
        'CNY' => 'CNY',
        'TRY' => 'TRY',
        'NOK' => 'NOK',
        'RUB' => 'RUR',
        'XDR' => 'XDR',
        'SGD' => 'SGD',
        'UAH' => 'UAH',
        'GBP' => 'GBP',
        'SEK' => 'SEK',
        'CHF' => 'CHF',
        'JPY' => 'JPY',
        'ALL' => 'ALL',
        'DZD' => 'DZD',
        'AOA' => 'AOA',
        'ARS' => 'ARS',
        'AMD' => 'AMD',
        'AFN' => 'AFN',
        'BDT' => 'BDT',
        'BHD' => 'BHD',
        'BGN' => 'BGN',
        'BOB' => 'BOB',
        'BWP' => 'BWP',
        'BRL' => 'BRL',
        'BND' => 'BND',
        'BIF' => 'BIF',
        'HUF' => 'HUF',
        'VEB' => 'VEB',
        'KRW' => 'KRW',
        'VND' => 'VND',
        'GMD' => 'GMD',
        'GHC' => 'GHC',
        'GNF' => 'GNF',
        'HKD' => 'HKD',
        'GEL' => 'GEL',
        'MKD' => 'MKD',
        'AED' => 'AED',
        'ZWD' => 'ZWD',
        'NAD' => 'NAD',
        'EGP' => 'EGP',
        'ZMK' => 'ZMK',
        'INR' => 'INR',
        'IDR' => 'IDR',
        'JOD' => 'JOD',
        'IQD' => 'IQD',
        'IRR' => 'IRR',
        'YER' => 'YER',
        'KHR' => 'KHR',
        'QAR' => 'QAR',
        'KES' => 'KES',
        'LAK' => 'LAK',
        'CYP' => 'CYP',
        'KGS' => 'KGS',
        'COP' => 'COP',
        'CDF' => 'CDF',
        'CRC' => 'CRC',
        'CUP' => 'CUP',
        'KWD' => 'KWD',
        'LVL' => 'LVL',
        'LBP' => 'LBP',
        'LYD' => 'LYD',
        'LTL' => 'LTL',
        'MUR' => 'MUR',
        'MRO' => 'MRO',
        'MWK' => 'MWK',
        'MGA' => 'MGA',
        'MYR' => 'MYR',
        'MTL' => 'MTL',
        'MAD' => 'MAD',
        'MXN' => 'MXN',
        'MZN' => 'MZN',
        'MDL' => 'MDL',
        'MNT' => 'MNT',
        'NPR' => 'NPR',
        'NGN' => 'NGN',
        'NIO' => 'NIO',
        'NZD' => 'NZD',
        'ILS' => 'ILS',
        'RON' => 'RON',
        'TWD' => 'TWD',
        'OMR' => 'OMR',
        'PKR' => 'PKR',
        'PYG' => 'PYG',
        'PEN' => 'PEN',
        'PLN' => 'PLN',
        'SAR' => 'SAR',
        'SZL' => 'SZL',
        'KPW' => 'KPW',
        'SCR' => 'SCR',
        'CSD' => 'CSD',
        'SYP' => 'SYP',
        'SKK' => 'SKK',
        'SIT' => 'SIT',
        'SOS' => 'SOS',
        'SDD' => 'SDD',
        'SRD' => 'SRD',
        'SLL' => 'SLL',
        'TJS' => 'TJS',
        'THB' => 'THB',
        'TZS' => 'TZS',
        'TND' => 'TND',
        'TMM' => 'TMM',
        'UGX' => 'UGX',
        'UZS' => 'UZS',
        'UYU' => 'UYU',
        'PHP' => 'PHP',
        'DJF' => 'DJF',
        'XAF' => 'XAF',
        'XOF' => 'XOF',
        'HRK' => 'HRK',
        'CZK' => 'CZK',
        'CLP' => 'CLP',
        'LKR' => 'LKR',
        'EEK' => 'EEK',
        'ETB' => 'ETB',
        'ZAR' => 'ZAR',
    );
    
    /**
     * Get session
     *
     * @return Mage_Core_Model_Session
     */
    public function getSession()
    {
        return Mage::getSingleton('core/session');
    }

    /**
     * Set session order id
     *
     * @param int $orderID order id
     * 
     * @return void
     */
    public function setOrderId($orderID)
    {
        $this->getSession()->setAssistOrderId($orderID);
    }

    /**
     * Get order id from session
     *
     * @param boolean $anew anew flag
     *
     * @return int
     */
    public function getOrderId($anew = false)
    {
        if ($anew) {
            $orderID = $this->getSession()->getAssistOrderId();
        } else {
            $orderID = $this->getCheckout()->getLastRealOrderId();
        }
        return $orderID;
    }

    /**
     * Get checkout session
     *
     * @return Mage_Checkout_Model_Session
     */
    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    /**
     * Get order place redirect url
     *
     * @return void
     */
    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getUrl('assist/redirect', array('_secure' => true));
    }

    /**
     * Get Assist gateway url
     *
     * @return string
     */
    public function getAssistUrl()
    {
        return ($this->getDebugFlag())
            ? self::ASSIST_URL_DEBUG
            : self::ASSIST_URL;
    }

    /**
     * Get succes url
     *
     * @return string
     */
    public function getSuccessUrl()
    {
        return Mage::getUrl('assist/redirect/success', array('_secure' => true));
    }

    /**
     * Get failure url
     *
     * @return string
     */
    public function getFailureUrl()
    {
        return Mage::getUrl('assist/redirect/failure', array('_secure' => true));
    }

    /**
     * Get current app language
     *
     * @return string
     */
    public function getCurrentLanguage()
    {
        return Mage::app()->getLocale()->getLocale()->getLanguage();
    }

    /**
     * Get checkout form fields
     *
     * @return array
     */
    public function getAssistCheckoutFormFields()
    {
        try {

            $orderId = $this->getOrderId();
            if (!$this->getConfigData('shop_id')) {
                Mage::throwException(Mage::helper('assist')->__('Invalid Assist Shop ID.'));
            }

            $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);

            $amount = $order->getGrandTotal();
            $currencyCode = $order->getOrderCurrencyCode();
            if (!isset($this->assistCurrencyCode[$currencyCode])) {
                $amount = Mage::helper('directory')
                    ->currencyConvert($amount, $currencyCode, $this->getConfigData('assist_currency_code'));
                $currencyCode = $this->getConfigData('assist_currency_code');
            }

            $lang = $this->getCurrentLanguage();
            if (!isset($this->assistLanguageCode[$lang])) {
                $lang = $this->getConfigData('assist_language');
            }

            $fields = array(
                'Merchant_ID'   => $this->getConfigData('shop_id'),
                'OrderNumber'   => $orderId,
                'OrderAmount'   => sprintf('%.2f', $amount),
                'OrderCurrency' => $this->assistCurrencyCode[$currencyCode],
                'Language'      => $this->assistLanguageCode[$lang],
                'Delay'         => 0,
                'URL_RETURN_OK' => $this->getSuccessUrl(),
                'URL_RETURN_NO' => $this->getFailureUrl(),
                'OrderComment'  => Mage::helper('assist')->__('Payment for order #%d', $orderId),
                'Email'         => $order->getCustomerEmail(),
            );
            $this->_addCustomerBillingAddress($order, $fields);
            $this->_addDisabledPayments($fields);

            if ($this->getDebugFlag()) {
                $fields['DemoResult'] = $this->getConfigData('assist_debug_result');
                $fields['TestMode']   = 1;
            }

            return $fields;
        } catch (Exception $e) {
            Mage::logException($e);
            return array('OrderNumber' => $this->getOrderId());
        }
    }

    /**
     * Add billing address to fields
     *
     * @param Mage_Sales_Model_Order $order   order
     * @param array                  &$fields fields array
     * 
     * @return void
     */
    protected function _addCustomerBillingAddress($order, &$fields)
    {
        if ($billing = $order->getBillingAddress()) {
            $address = array (
                    'Lastname'      => $billing->getFirstname(),
                    'Firstname'     => $billing->getLastname(),
                    'MobilePhone'   => $billing->getTelephone(),
                    'Address'       => $billing->getStreet(1),
                    'Country'       => $billing->getCountry(),
                    'State'         => $billing->getRegion(),
                    'City'          => $billing->getCity(),
                    'Zip'           => $billing->getPostcode(),
                );
            $fields = array_merge($fields, $address);
        }
        return;
    }

    /**
     * Add disabled payments
     * 
     * @param array &$fields fields array
     * 
     * @return void
     */
    protected function _addDisabledPayments(&$fields)
    {
        $allowedPayments = $this->getConfigData('assist_payment_methods');
        $allowedPayments = array_flip(explode(',', $allowedPayments));
        $options = Mage::getModel('assist/source_paymentMethods')->toOptionArray();
        $disabledPayments = array();
        foreach ($options as $option) {
            if (!array_key_exists($option['value'], $allowedPayments)) {
                $disabledPayments[$option['value']] = 0;
            }
        }
        $fields = array_merge($fields, $disabledPayments);
        return;
    }

    /**
     * Check order id is valid
     *
     * @param int $orderId int
     *
     * @return boolean
     */
    public function isValidOrderId($orderId)
    {
        $order = Mage::getModel('sales/order');
        $order->loadByIncrementId($orderId);

        return (bool) $order->getId();
    }

    /**
     * Update order status
     *
     * @param int  $orderId order id
     * @param bool $isOk    success flag
     *
     * @return bool
     */
    public function updateOrderStatus($orderId, $isOk)
    {
        $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);

        if ($isOk) {
            $status = $this->getConfigData('order_status_ok');
            $this->payInvoice($order->getPayment(), $order->getBaseGrandTotal());
        } else {
            $status = $this->getConfigData('order_status_no');
        }

        if ($status == 'pending') {
            $status = Mage_Sales_Model_Order::STATE_NEW;
        }

        if ($this->isValidStatus($status, $order)) {
            $order->setState($status, true)->save();
            return true;
        }
    }

    /**
     * Check is valid order status
     *
     * @param string                 $status status
     * @param Mage_Sales_Model_Order $order  order
     *
     * @return boolean
     */
    public function isValidStatus($status, $order)
    {
        switch ($status)
        {
            case Mage_Sales_Model_Order::STATE_NEW:
            case Mage_Sales_Model_Order::STATE_PROCESSING:
                return true;
                break;
            case Mage_Sales_Model_Order::STATE_CANCELED:
                return $order->canCancel();
                break;
            case Mage_Sales_Model_Order::STATE_HOLDED:
                return $order->canHold();
                break;
        }
        return false;
    }

    /**
     * Check confirm request
     *
     * @param Mage_Core_Controller_Request_Http $request request
     *
     * @return boolean
     */
    public function isValidRequest($request)
    {
        $shopId         = $request->getParam('merchant_id');
        $orderId        = $request->getParam('ordernumber');
        $orderAmount    = $request->getParam('amount');
        $orderCurrency  = $request->getParam('currency');
        $orderState     = $request->getParam('orderstate');
        $checkValue     = $request->getParam('checkvalue');
        $responseCode   = $request->getParam('responsecode');
        $check          = strtoupper(
                            md5(
                                strtoupper(md5($this->getConfigData('secret_word'))) .
                                strtoupper(md5($shopId . $orderId . $orderAmount . $orderCurrency . $orderState))
                            ));
        return ($this->isValidOrderId($orderId)
            && $shopId == $this->getConfigData('shop_id')
            && $orderAmount && $orderCurrency
            && $checkValue
            && $responseCode
            && $check == strtoupper($checkValue)
        );
    }

    /**
     * Cancel order
     *
     * @param Mage_Sales_Model_Order_Payment $payment payment
     *
     * @return void
     */
    public function cancel(Varien_Object $payment)
    {
        $client = new Zend_Http_Client();
        $client->setUri(self::ASSIST_CANCEL_URL)
            ->setMethod(Zend_Http_Client::POST)
            ->setParameterPost('Billnumber', $payment->getAdditionalInformation('Billnumber'))
            ->setParameterPost('Merchant_ID', $this->getConfigData('shop_id'))
            ->setParameterPost('Login', $this->getConfigData('login'))
            ->setParameterPost('Password', $this->getConfigData('password'))
            ->setParameterPost('CancelReason', $this->_getCancelReasonCode())
            ->setParameterPost('Language', $this->getConfigData('assist_language'))
            ->setParameterPost('Format', self::ASSIST_RESPONSE_FORMAT_XML);
        $this->_processResponse($client->request());
    }

    /**
     * Get assist cancel reason code
     *
     * @return int
     */
    protected function _getCancelReasonCode()
    {
        return (Mage::app()->getStore()->getId() == Mage_Core_Model_App::ADMIN_STORE_ID)
            ? self::SELLER_REJECTION
            : self::CUSTOMER_REJECTION;

    }

    /**
     * Refund specified amount for payment
     *
     * @param Mage_Sales_Order_Payment $payment payment object
     * @param float                    $amount  amount to refund
     *
     * @return Mage_Payment_Model_Abstract
     */
    public function refund(Varien_Object $payment, $amount)
    {

        $order = $payment->getOrder();
        $client = new Zend_Http_Client();
        $client->setUri(self::ASSIST_CANCEL_URL)
            ->setMethod(Zend_Http_Client::POST)
            ->setParameterPost('Billnumber', $payment->getAdditionalInformation('Billnumber'))
            ->setParameterPost('Merchant_ID', $this->getConfigData('shop_id'))
            ->setParameterPost('Login', $this->getConfigData('login'))
            ->setParameterPost('Password', $this->getConfigData('password'))
            ->setParameterPost('CancelReason', $this->_getCancelReasonCode())
            ->setParameterPost('Language', $this->getConfigData('assist_language'))
            ->setParameterPost('Amount', $amount)
            ->setParameterPost('Currency', $order->getOrderCurrencyCode())
            ->setParameterPost('Format', self::ASSIST_RESPONSE_FORMAT_XML);
        $this->_processResponse($client->request());

        return $this;
    }

    /**
     * Process xml response
     *
     * @param Zend_Http_Response $response response
     *
     * @return void
     */
    protected function _processResponse($response)
    {
        $xml = new SimpleXMLElement($response->getBody());
        foreach ($xml->attributes() as $attributeName => $value) {
            if (strpos($attributeName, 'code') !== false && $value != 0) {
                Mage::throwException('Where has been an error while processing your order');
            }
        }
    }

    /**
     * Create invoice and pay
     *
     * @param Mage_Sales_Model_Order_Payment $payment payment
     * @param float                          $amount  amount
     *
     * @return Mage_Payment_Model_Abstract
     */
    public function payInvoice(Varien_Object $payment, $amount)
    {
        $payment->registerCaptureNotification($amount);
        return $this;
    }

    /**
     * Authorize order
     *
     * @param Mage_Sales_Model_Order $order         order
     * @param string                 $transactionId request
     *
     * @return void
     */
    public function authorizeOrder($order, $transactionId)
    {
        $payment = $order->getPayment();
        if (strpos($transactionId, '.') !== false) {
            $transactionId = explode('.', $transactionId);
            $transactionId = $transactionId[0];
        }
        if ($payment->lookupTransaction($transactionId, Mage_Sales_Model_Order_Payment_Transaction::TYPE_AUTH)) {
            return $this;
        }
        $payment->setTransactionId($transactionId);
        $payment->authorize(true, $order->getBaseGrandTotal());
        $payment->setAdditionalInformation('Billnumber', $transactionId)
            ->save();
        $order->save();
        return $this;
    }
}
