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
 * Adding a new product attribute "Additional shipping cost".
 */

/** @var Symmetrics_Education_Model_Resource_Setup $this */
$installer = $this;
$installer->startSetup();

$arrayAttributes = array(
    'group' => 'Education',
    'type' => 'decimal',
    'backend' => 'catalog/product_attribute_backend_price',
    'label' => 'Additional shipping cost',
    'input' => 'price',
    'class' => '',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'sort_order' => 2,
    'visible' => true,
    'required' => false,
    'default' => '',
    'apply_to' => 'simple,configurable,virtual',
);

// adding attribute
$installer->addAttribute('catalog_product', 'additional_shipping_cost', $arrayAttributes);
$installer->updateAttribute('catalog_product', 'additional_shipping_cost', $arrayAttributes);
$installer->endSetup();