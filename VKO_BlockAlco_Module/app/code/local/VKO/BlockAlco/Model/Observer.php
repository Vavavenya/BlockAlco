<?php

class VKO_BlockAlco_Model_Observer
{

    public function beforeCheckItemsAvaible(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();
        $product = $event->getProduct();

        static $lastGoods;

        $helperBlockAlco = Mage::helper('vko_blockalco/time');

        $timeBlock = Mage::helper('vko_blockalco/time')->getSelectedTime('vko_options/settings/time_block');
        $timeAccess = Mage::helper('vko_blockalco/time')->getSelectedTime('vko_options/settings/time_unlock');

        $access = $helperBlockAlco->getAccessForBuyAlcohol();


        if ($product->getData('forbidden_alcohol') && $access <> true && $lastGoods <> $product->getData('name')){
            echo "Alcohol banned $timeBlock until $timeAccess";
            $product->setData('is_salable',0);
            $lastGoods = $product->getData('name');
        }

    }
}
