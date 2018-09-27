<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2006-2018 Magento, Inc. (http://www.magento.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class VKO_BlockAlco_Helper_Time extends Mage_Core_Helper_Abstract
{

    public function getAccessForBuyAlcohol()
    {

        $currentTime = Mage::getModel('core/date')->date('H:i');

        $blockTime = $this->getSelectedTime('vko_options/settings/time_block');
        $accessTime = $this->getSelectedTime('vko_options/settings/time_unlock');

        $accessForSelling = false;

        if (strtotime($accessTime) > strtotime($blockTime)) {
            if (strtotime($currentTime) > strtotime($blockTime)
                && (strtotime($currentTime) < strtotime($accessTime))) {
                $accessForSelling = false;
            } else {
                $accessForSelling = true;
            }
        } else {

            if (strtotime($accessTime) < strtotime($blockTime)) {   // ban: 23:00 , unlock: 9:00
                if (strtotime($accessTime) > strtotime($blockTime)
                    || strtotime($currentTime) < strtotime($accessTime)){
                    $accessForSelling = false;
                } else {
                    $accessForSelling = true;
                }
            }
        }

        return $accessForSelling;
    }

    public function getSelectedTime($pathToElementTab)
    {
        $selectedTime = Mage::getStoreConfig($pathToElementTab);

        $selectedTimeWithDots = str_replace(',', ':', $selectedTime);

        $formatedTime = substr($selectedTimeWithDots, 0, 5);

        return $formatedTime;
    }
}