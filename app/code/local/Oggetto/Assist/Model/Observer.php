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
 * @copyright  Copyright (C) 2012 
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Assist payment module observer
 *
 * @category   Oggetto
 * @package    Oggetto_Assist
 * @subpackage Model
 * @author     
 */
class Oggetto_Assist_Model_Observer extends Mage_Core_Model_Abstract
{
    /**
     * Cancel assist order
     *
     * @param Varien_Event_Observer $observer obsever
     *
     * @return void
     */
    public function cancelAssistOrder(Varien_Event_Observer $observer)
    {
        if ($observer->getPayment()->getMethodInstance()->getCode() == 'assist') {
            Mage::getModel('assist/payment')->cancel($observer->getPayment());
        }
    }
}
