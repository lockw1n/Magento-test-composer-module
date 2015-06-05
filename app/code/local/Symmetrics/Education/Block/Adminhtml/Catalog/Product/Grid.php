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
 * Adminhtml product grid block.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Block_Adminhtml_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    /**
     * @const int Price actions.
     */
    const ACTION_PLUS = 1,
          ACTION_MINUS = 2,
          ACTION_PLUS_PERCENTAGE = 3,
          ACTION_MINUS_PERCENTAGE = 4,
          ACTION_MULTIPLICATION = 5;

    /**
     * Add column to products grid.
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumnAfter(
            'is_top',
            array(
                'header' => $this->__('TOP'),
                'width' => '70px',
                'index' => 'is_top',
                'sortable' => false,
                'type' => 'options',
                'options' => Mage::getSingleton('eav/entity_attribute_source_boolean')->getOptionArray(),
                'renderer' => 'education/product'
            ),
            'name'
        );
        return parent::_prepareColumns();
    }

    /**
     * Add column "is_top" to select.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = parent::_prepareCollection()->getCollection();
        $collection->addAttributeToSelect('is_top');
        return $this;
    }

    /**
     * Add new mass action, which provide updating price of products.
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        parent::_prepareMassaction();

        // Append new mass action option
        $this->getMassactionBlock()->addItem(
            'update_price',
            array(
                'label' => $this->__('Update price'),
                'url' => $this->getUrl(
                    '*/*/massUpdatePrice'
                ),
                'additional' => array(
                    'action' => array(
                        'name' => 'update_price_action',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => $this->__('Price action'),
                        'values' => $this->getPriceActions(),
                    ),
                    'value' => array(
                        'name' => 'update_price_value',
                        'type' => 'text',
                        'class' => 'required-entry',
                        'label' => $this->__('Price value'),
                    ),
                ),
            )
        );
        return $this;
    }

    /**
     * Get array with price actions.
     *
     * @return array
     */
    protected function getPriceActions()
    {
        return array(
            self::ACTION_PLUS => '+ n',
            self::ACTION_MINUS => '− n',
            self::ACTION_PLUS_PERCENTAGE => '+ n%',
            self::ACTION_MINUS_PERCENTAGE => '− n%',
            self::ACTION_MULTIPLICATION => '* n',
        );
    }
}
