<?php
/**
 * Oggetto Web extension for Magento
 *
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
class Oggetto_Assist_Model_Source_TestResponseCode
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'AS000', 
                'label' => Mage::helper('assist')->__('(AS000) Authorisation completed')
                ),
            array(
                'value' => 'AS100', 
                'label' => Mage::helper('assist')->__('(AS100) Authorisation refused')
                ),
            array(
                'value' => 'AS101', 
                'label' => Mage::helper('assist')->__('(AS101) Authorisation refused (invalid card number)')
                ),
            array(
                'value' => 'AS102', 
                'label' => Mage::helper('assist')->__('(AS102) Authorisation refused (limit exceeded)')
                ),
            array(
                'value' => 'AS104', 
                'label' => Mage::helper('assist')->__('(AS104) Authorisation refused (invalid exparation date)')
                ),
            array(
                'value' => 'AS105', 
                'label' => Mage::helper('assist')->__('(AS105) Authorisation refused (limit exceeded)')
                ),
            array(
                'value' => 'AS106', 
                'label' => Mage::helper('assist')->__('(AS106) Authorisation refused (invalid PIN-code)')
                ),
            array(
                'value' => 'AS107', 
                'label' => Mage::helper('assist')->__('(AS107) Authorisation refused (data transmition error)')
                ),
            array(
                'value' => 'AS108', 
                'label' => Mage::helper('assist')->__('(AS108) Authorisation refused (fraud suspicion)')
                ),
            array(
                'value' => 'AS109', 
                'label' => Mage::helper('assist')->__('(AS109) Authorisation refused (limit exceeded)')
                ),
            array(
                'value' => 'AS200', 
                'label' => Mage::helper('assist')->__('(AS200) Authorisation should be repeated')
                ),
            array(
                'value' => 'AS998', 
                'label' => Mage::helper('assist')->__('(AS998) Internal error')
                ),
        );
    }
}
