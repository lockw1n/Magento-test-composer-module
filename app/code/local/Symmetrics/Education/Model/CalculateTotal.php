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
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */

/**
 * Calculations for total models.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Model_CalculateTotal extends Varien_Object
{
    /**
     * Calculate additional shipping cost.
     *
     * @param array $items Order or cart items.
     *
     * @return int
     */
    public function calculateTotal(array $items)
    {
        $baseCost = 0;

        foreach ($items as $item) {
            if ($item instanceof Mage_Sales_Model_Quote_Item || $item instanceof Mage_Sales_Model_Order_Item) {
                $additionalCost = $item->getData('additional_shipping_cost');
                if ($item instanceof Mage_Sales_Model_Order_Item) {
                    $qty = $item->getQtyOrdered();
                } else {
                    $qty = $item->getQty();
                }
            } else {
                $additionalCost = $item->getOrderItem()->getData('additional_shipping_cost');
                $qty = $item->getQty();
            }

            $baseCost += $additionalCost * $qty;
        }

        return $baseCost;
    }

    /**
     * Add additional shipping cost to totals.
     *
     * @param float       $baseCost Additional shipping cost.
     * @param object      $object   Total object.
     * @param string|null $type     Type of total object.
     *
     * @return void
     */
    public function addToTotal($baseCost, $object, $type = null)
    {
        if ($baseCost) {
            $cost = Mage::app()->getStore()->convertPrice($baseCost);

            if (isset($type) && $type == 'quote') {
                $object->setAdditionalShippingCost($baseCost);
            }

            $object->setBaseGrandTotal(
                $object->getBaseGrandTotal() + $cost
            );
            $object->setGrandTotal($object->getGrandTotal() + $cost);
        }
    }
}