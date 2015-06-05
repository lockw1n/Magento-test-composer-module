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

/** @var Symmetrics_Education_Model_Resource_Setup $this */
$installer = $this;
$installer->startSetup();

// adding attribute group
$installer->addAttributeGroup('catalog_product', 'Default', 'Education', 1000);

// adding attribute
$installer->addAttribute(
    'catalog_product',
    'is_top',
    array(
        'group'            => 'Education',
        'type'             => 'int',
        'backend'          => '',
        'frontend'         => '',
        'label'            => 'Enable "Is top" for product',
        'input'            => 'select',
        'class'            => '',
        'source'           => 'eav/entity_attribute_source_boolean',
        'global'           => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'          => true,
        'required'         => false,
        'user_defined'     => false,
        'default'          => Mage_Eav_Model_Entity_Attribute_Source_Boolean::VALUE_NO,
        'searchable'       => false,
        'filterable'       => false,
        'comparable'       => false,
        'visible_on_front' => false,
        'unique'           => false,
        'is_configurable'  => false,
    )
);
$installer->endSetup();