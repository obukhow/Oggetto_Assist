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
    const ASSIST_URL            = 'https://payments.paysecure.ru/pay/order.cfm';
    const ASSIST_URL_DEBUG      = 'https://payments.paysecure.ru/pay/order.cfm';
    const ASSIST_POST_CHARSET   = 'UTF-8';

    protected $_code          = 'assist';
    protected $_formBlockType = 'assist/form';
    protected $_infoBlockType = 'assist/info';

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
     * @param boolean $anew anew flag
     *
     * @return void
     */
    public function getOrderPlaceRedirectUrl($anew = false)
    {
        return Mage::getUrl('assist/redirect', array('_secure' => true, '_query' => array('anew' => $anew)));
    }

    /**
     * Get Assist gateway url
     *
     * @return string
     */
    public function getAssistUrl()
    {
        return (Mage::getStoreConfigFlag('payment/assist/developer_mode'))
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
        return Mage::getUrl('checkout/onepage/success', array('_secure' => true));
    }

    /**
     * Get failure url
     *
     * @return string
     */
    public function getFailureUrl()
    {
        return Mage::getUrl('checkout/onepage/failure', array('_secure' => true));
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
     * @param boolean $anew anew flag
     *
     * @return array
     */
    public function getAssistCheckoutFormFields($anew = false)
    {
        $orderId = $this->getOrderId($anew);
        $config = Mage::getStoreConfig('payment/assist');
        try {
            $payment = explode(',', $config['assist_payment_methods']);
            $payment = array_flip($payment);

            $order = Mage::getModel('sales/order');
            $order->loadByIncrementId($orderId);

            $billing = $order->getBillingAddress();

            $amount = $order->getGrandTotal();
            $currencyCode = $order->getOrderCurrencyCode();
            if (!isset($this->assistCurrencyCode[$currencyCode])) {
                $amount = Mage::helper('directory')
                    ->currencyConvert($amount, $currencyCode, $config['assist_currency_code']);
                $currencyCode = $config['assist_currency_code'];
            }

            $lang = $this->getCurrentLanguage();
            if (!isset($this->assistLanguageCode[$lang])) {
                $lang = $config['assist_language'];
            }
            $fields = array(
                'Merchant_ID'   => $config['shop_id'],
                'OrderNumber'   => $orderId,
                'OrderAmount'   => sprintf('%.2f', $amount),
                'OrderCurrency' => $this->assistCurrencyCode[$currencyCode],
                'Language'      => $this->assistLanguageCode[$lang],
                'Delay'         => 0,
                'URL_RETURN_OK' => $this->getSuccessUrl(),
                'URL_RETURN_NO' => $this->getFailureUrl(),
                'OrderComment'  => iconv('UTF-8', self::ASSIST_POST_CHARSET,
                        Mage::helper('assist')->__('Payment for order #%d', $orderId)),
                'LastName'      => iconv('UTF-8', self::ASSIST_POST_CHARSET, $billing->getFirstname()),
                'FirstName'     => iconv('UTF-8', self::ASSIST_POST_CHARSET, $billing->getLastname()),
                'Email'         => $order->getCustomerEmail(),
                'MobilePhone'   => $billing->getTelephone(),
                'Address'       => iconv('UTF-8', self::ASSIST_POST_CHARSET, $billing->getStreet(1)),
                'Country'       => $billing->getCountry(),
                'State'         => iconv('UTF-8', self::ASSIST_POST_CHARSET, $billing->getRegion()),
                'City'          => iconv('UTF-8', self::ASSIST_POST_CHARSET, $billing->getCity()),
                'Zip'           => $billing->getPostcode(),
            );

            if (Mage::getStoreConfig('payment/assist/developer_mode')) {
                $fields['DemoResult']   = Mage::getStoreConfig('payment/assist/assist_debug_result');
                $fields['TestMode']     = 1;
            }


            if (!$fields['Merchant_ID']) {
                Mage::throwException(Mage::helper('assist')->__('Invalid Assist Shop ID.'));
            }

            return $fields;
        } catch (Exception $e) {
            Mage::logException($e);
            return array('OrderNumber' => $orderId);
        }
    }
}
