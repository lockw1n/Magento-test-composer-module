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
 * Adding a new column "additional_shipping_cost" to quote item and order item.
 */

/** @var Symmetrics_Education_Model_Resource_Setup $this */
$installer = $this;

$installer->startSetup();

$installer->getConnection()
    ->addColumn(
        $this->getTable('sales_flat_quote_item'),
        'additional_shipping_cost',
        'decimal(12,4) NOT NULL DEFAULT \'0.0000\' AFTER  `price`'
    );
$installer->getConnection()
    ->addColumn(
        $this->getTable('sales_flat_order_item'),
        'additional_shipping_cost',
        'decimal(12,4) NOT NULL DEFAULT \'0.0000\' AFTER  `price`'
    );

$installer->endSetup();