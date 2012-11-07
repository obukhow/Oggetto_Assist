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
 * Assist redirect controller
 *
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @subpackage controllers
 * @author     Denis Obukhov <denis.obukhov@oggettoweb.com>
 */
class Oggetto_Assist_RedirectController extends Mage_Core_Controller_Front_Action
{

    /**
     * Ajax expiration check
     *
     * @return mixed
     */
    protected function _expireAjax()
    {
        if (!Mage::getSingleton('checkout/session')->getQuote()->hasItems()) {
            return $this->getResponse()->setHeader('HTTP/1.1', '403 Session Expired');
        }
    }

    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $anew = (bool)$this->getRequest()->getParam('anew');
        $this->getResponse()
            ->setHeader('Content-type', 'text/html; charset=' . Oggetto_Assist_Model_Checkout::ASSIST_POST_CHARSET)
            ->setBody(
                $this->getLayout()
                    ->createBlock('assist/redirect')->setAnew($anew)
                    ->toHtml()
            );
    }

    /**
     * Confirm action
     *
     * @return void
     */
    public function confirmAction()
    {
        if ($this->getRequest()->isPost()) {
            $request        = $this->getRequest();
            $orderId        = $request->getParam('OrderNumber');
            $shopId         = $request->getParam('Merchant_ID', $request->getParam('Shop_IDP'));
            $orderTotal     = $request->getParam('Total', $request->getParam('OrderAmount'));
            $orderCurrency  = $request->getParam('OrderCurrency', $request->getParam('Currency'));
            $checkValue     = $request->getParam('CheckValue');
            $responseCode   = $request->getParam('Response_Code');
            $check          = strtoupper(md5($shopId . $orderId . $orderTotal .
                    $orderCurrency . Mage::getStoreConfig('payment/assist/secret_word')));
            if ($this->isValidOrderId($orderId)
                && $shopId == Mage::getStoreConfig('payment/assist/shop_id')
                && $orderTotal && $orderCurrency
                && $checkValue
                && $responseCode
                && $check == strtoupper($checkValue)
            ) {
                $this->updateOrderStatus($orderId, (strtoupper($responseCode) == 'AS000'));
            }
            if (Mage::getStoreConfig('payment/assist/developer_mode')) {
                Mage::log('post', null, 'assist_payment.log');
                Mage::log($request->getParams(), null, 'assist_payment.log');
            }
        }
    }

    /**
     * Failure action
     *
     * @return void
     */
    public function failureAction()
    {
          $this->_redirect('checkout/onepage/failure', array('_secure' => true));
    }

    /**
     * Success action
     *
     * @return void
     */
    public function successAction()
    {
          $this->_redirect('checkout/onepage/success', array('_secure' => true));
    }

    /**
     * Check order id is valid
     *
     * @param int $orderId int
     *
     * @return boolean
     */
    private function isValidOrderId($orderId)
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
    private function updateOrderStatus($orderId, $isOk)
    {
        $order = Mage::getModel('sales/order');
        $order->loadByIncrementId($orderId);

        if ($isOk) {
            $status = Mage::getStoreConfig('payment/assist/order_status_ok');
        } else {
            $status = Mage::getStoreConfig('payment/assist/order_status_no');
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
    private function isValidStatus($status, $order)
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
}
