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
 * Add new total "additional_shipping_cost" to Sales Quote Address Total model.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Model_Total_Quote_AdditionalShippingCost
    extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    /**
     * Setup code.
     */
    public function __construct()
    {
        $this->setCode('additional_shipping_cost');
    }

    /**
     * Get Shipping label.
     *
     * @return string
     */
    public function getLabel()
    {
        return Mage::helper('education')->__('Additional shipping cost');
    }

    /**
     * Collect totals process.
     *
     * @param Mage_Sales_Model_Quote_Address $address Sales Quote address model.
     *
     * @return $this
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        if ($address->getAddressType() == Mage_Customer_Model_Address_Abstract::TYPE_BILLING) {
            return $this;
        }

        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $cartItems = $quote->getAllVisibleItems();

        /** @var Symmetrics_Education_Model_CalculateTotal $calculationTotals */
        $calculationTotals = Mage::getSingleton('education/calculateTotal');

        $additionalCost = $calculationTotals->calculateTotal($cartItems);
        $calculationTotals->addToTotal($additionalCost, $address, 'quote');

        return $this;
    }

    /**
     * Fetch (Retrieve data as array).
     *
     * @param Mage_Sales_Model_Quote_Address $address Sales Quote address model.
     *
     * @return $this
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $amount = $address->getAdditionalShippingCost();

        if ($amount) {
            $address->addTotal(
                array(
                    'code' => $this->getCode(),
                    'title' => $this->getLabel(),
                    'value' => $amount,
                )
            );
        }

        return $this;
    }
}