<?php

class VKO_BlockAlco_Model_ObserverCart
{
    public function beforeRenderCart(Varien_Event_Observer $observer)
    {
        $helperBlockAlco = Mage::helper('vko_blockalco/time');
        $access = $helperBlockAlco->getAccessForBuyAlcohol();

        if (!$access) {
            $block = $observer->getBlock();

            if ($block instanceof Mage_Page_Block_Html_Header) {
                $helperBlockAlco = Mage::helper('vko_blockalco/cart');
                $helperBlockAlco->checkInCartItems();


            }
        }
    }
}