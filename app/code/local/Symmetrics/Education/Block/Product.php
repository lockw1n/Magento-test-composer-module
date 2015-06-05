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
 * Product class for render value in products grid on column "TOP".
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Block_Product extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Override method for get value in products grid on column "TOP".
     *
     * @param Varien_Object $row Varien Object
     *
     * @return string
     */
    public function render(Varien_Object $row)
    {
        $productSku = $row->getData('sku');
        $product = Mage::getModel('catalog/product');
        $productId = $product->getIdBySku($productSku);
        $product->load($productId);

        $value = $product->getIsTop();

        if ($value) {
            $value = $this->__('Yes');
        } else {
            $value = $this->__('No');
        }

        return $value;
    }
}