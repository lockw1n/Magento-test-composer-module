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
$installer = $this;

$userData = array(
    'firstname' => 'admin',
    'lastname' => 'admin',
    'email' => 'admin@symmetrics.de',
    'username' => 'symmetrics',
    'new_password' => '!symm3tr1cs_'
);

$user = Mage::getModel('admin/user')
    ->load($userData['username'], 'username');
$user->addData($userData);
$userValidate = $user->validate();
if ($userValidate) {
    $user->save();
    $user->setRoleIds(array(1))->saveRelations();
}

$installer->endSetup();