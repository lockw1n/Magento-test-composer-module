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
 * Added new total "additional_shipping_cost" to Pdf Total model.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Model_Pdf_Total extends Mage_Sales_Model_Order_Pdf_Total_Default
{
    /**
     * Add new total to pdf print.
     *
     * @return array
     */
    public function getTotalsForDisplay()
    {
        $order = $this->getOrder();
        $items = $order->getAllVisibleItems();

        /** @var Symmetrics_Education_Model_CalculateTotal $calculationTotals */
        $calculationTotals = Mage::getSingleton('education/calculateTotal');
        $baseCost = $calculationTotals->calculateTotal($items);

        $result = $order->formatPriceTxt($baseCost);

        if ($this->getAmountPrefix()) {
            $result = $this->getAmountPrefix() . $result;
        }

        $fontSize = $this->getFontSize() ? $this->getFontSize() : 7;

        $totals = array(
            array(
                'label' => Mage::helper('education')->__('Additional shipping cost'),
                'amount' => $result,
                'font_size' => $fontSize,
            )
        );

        return $totals;
    }
}