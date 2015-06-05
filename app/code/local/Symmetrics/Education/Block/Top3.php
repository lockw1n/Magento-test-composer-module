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
 * Block class for Top 3 widget.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Block_Top3 extends Mage_Core_Block_Template
{
    /**
     * Get collection of products which marked as "is_top"
     * and sort it randomly, count of products taken from
     * system config in Education tab.
     *
     * @return object Mage_Catalog_Model_Resource_Product_Collection
     */
    public function getTopProducts()
    {
        $countProducts = Mage::getStoreConfig('education_config/education_group/number_of_products');
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(
                array(
                    array('attribute' => 'is_top', 'eq' => true)
                )
            )
            ->setPageSize($countProducts);

        $collection->getSelect()->order(new Zend_Db_Expr('RAND()'));

        return $collection;
    }

    /**
     * Get title of widget "Top 3", it is taken form
     * system config in Education tab.
     *
     * @return string
     */
    public function getWidgetName()
    {
        return Mage::getStoreConfig('education_config/education_group/title_of_block');
    }

    /**
     * Get html with product price.
     *
     * @param Mage_Catalog_Model_product $product Product model.
     *
     * @return string
     */
    public function getPrice($product)
    {
        $html = Mage::app()
            ->getLayout()
            ->createBlock('catalog/product_price')
            ->getPriceHtml($product, true);
        return $html;
    }
}