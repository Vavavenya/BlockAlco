<?php

class VKO_BlockAlco_Helper_Cart extends Mage_Core_Helper_Abstract
{

    public function checkInCartItems()
    {
        $cartHelper = Mage::helper('checkout/cart');
        $items = $cartHelper->getCart()->getItems();
        foreach ($items as $item) {
            $product = $this->getProductByItem($item);
            if ($product->getData('forbidden_alcohol')) {
                $this->deleteInCart($cartHelper, $item);
            }
        }
    }

    private function deleteInCart($cartHelper, $item)
    {
        $itemId = $item->getItemId();
        $cartHelper->getCart()->removeItem($itemId)->save();
    }

    private function getProductByItem($item)
    {
        $productId = $item->getProductId();
        $product = Mage::getModel('catalog/product')->load($productId);

        return $product;
    }
}
