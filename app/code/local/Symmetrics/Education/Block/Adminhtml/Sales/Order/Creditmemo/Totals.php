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
 * Add new field to credit memo block on backend.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Block_Adminhtml_Sales_Order_Creditmemo_Totals
    extends Mage_Adminhtml_Block_Sales_Order_Creditmemo_Totals
{
    /**
     * Initialize order totals array.
     *
     * @return $this
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        $orderItems = $this->getSource()->getAllItems();

        /** @var Symmetrics_Education_Model_CalculateTotal $calculationTotals */
        $calculationTotals = Mage::getSingleton('education/calculateTotal');
        $baseCost = $calculationTotals->calculateTotal($orderItems);

        if ($baseCost) {
            $this->addTotal(
                new Varien_Object(
                    array(
                        'code' => 'additional_shipping_cost',
                        'value' => $baseCost,
                        'base_value' => $baseCost,
                        'label' => $this->__('Additional shipping cost'),
                    )
                )
            );
        }

        return $this;
    }
}