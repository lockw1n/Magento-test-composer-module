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
 * Adding a new block which will contain a new "TOP 3" widget.
 * This widget will contain products which marked as "is_top".
 */

$cmsBlock = array(
    'title' => 'Top 3 products',
    'identifier' => 'top_3_products',
    'stores' => array(0), // Array with store ID's
    'content' => '{{widget type="education/widget_top3" template="symmetrics/education/top3.phtml"}}',
    'is_active' => 1
);

$this->addCmsBlock($cmsBlock);