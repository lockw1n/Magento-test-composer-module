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
 * Product controller for admin area.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Education
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @copyright 2015 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_Education_Catalog_ProductController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Update products price.
     *
     * @return void
     */
    public function massUpdatePriceAction()
    {
        $productIds = (array) $this->getRequest()->getParam('product');
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        $action = (int) $this->getRequest()->getParam('update_price_action');
        $value = (float) $this->getRequest()->getParam('update_price_value');

        /** @var Mage_Catalog_Model_Resource_Product_collection $productsCollection */
        $productsCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('is_top')
            ->addAttributeToFilter('entity_id', array('in' => $productIds));

        try {
            switch ($action) {
                case Symmetrics_Education_Block_Adminhtml_Catalog_Product_Grid::ACTION_PLUS:
                    $productsUpdated = $this->actionPlus($productsCollection, $value);
                    break;
                case Symmetrics_Education_Block_Adminhtml_Catalog_Product_Grid::ACTION_MINUS:
                    $productsUpdated = $this->actionMinus($productsCollection, $value);
                    break;
                case Symmetrics_Education_Block_Adminhtml_Catalog_Product_Grid::ACTION_PLUS_PERCENTAGE:
                    $productsUpdated = $this->actionPlusPercentage($productsCollection, $value);
                    break;
                case Symmetrics_Education_Block_Adminhtml_Catalog_Product_Grid::ACTION_MINUS_PERCENTAGE:
                    $productsUpdated = $this->actionMinusPercentage($productsCollection, $value);
                    break;
                case Symmetrics_Education_Block_Adminhtml_Catalog_Product_Grid::ACTION_MULTIPLICATION:
                    $productsUpdated = $this->actionMultiplication($productsCollection, $value);
                    break;
                default:
                    $productsUpdated = 0;
                    break;
            }

            $productsCollection->save();

            $this->_getSession()->addSuccess(
                Mage::helper('adminhtml')->__('Total of %d record(s) have been updated.', $productsUpdated)
            );
        } catch (Mage_Core_Exception $exception) {
            $this->_getSession()->addError($exception->getMessage());
        } catch (Exception $exception) {
            $this->_getSession()
                ->addException(
                    $exception,
                    Mage::helper('adminhtml')->__('An error occurred while updating the product(s) price.')
                );
        }

        $this->_redirect('*/catalog_product/', array('store' => $storeId));
    }

    /**
     * Update products price with action plus.
     *
     * @param Mage_Catalog_Model_Resource_Product_collection $productsCollection Products collection.
     * @param float                                          $value              Value for update.
     *
     * @return integer
     */
    protected function actionPlus($productsCollection, $value)
    {
        $productsUpdated = 0;

        foreach ($productsCollection as $product) {
            $oldPrice = $product->getPrice();
            $newPrice = round($oldPrice + $value, 2);
            if ($newPrice > 0) {
                $product->setPrice($newPrice);
                $productsUpdated++;
            }
        }

        return $productsUpdated;
    }

    /**
     * Update products price with action minus.
     *
     * @param Mage_Catalog_Model_Resource_Product_collection $productsCollection Products collection.
     * @param float                                          $value              Value for update.
     *
     * @return integer
     */
    protected function actionMinus($productsCollection, $value)
    {
        $productsUpdated = 0;

        foreach ($productsCollection as $product) {
            $oldPrice = $product->getPrice();
            $newPrice = round($oldPrice - $value, 2);
            if ($newPrice > 0) {
                $product->setPrice($newPrice);
                $productsUpdated++;
            }
        }

        return $productsUpdated;
    }

    /**
     * Update products price with action plus percentage.
     *
     * @param Mage_Catalog_Model_Resource_Product_collection $productsCollection Products collection.
     * @param float                                          $value              Value for update.
     *
     * @return integer
     */
    protected function actionPlusPercentage($productsCollection, $value)
    {
        $productsUpdated = 0;

        foreach ($productsCollection as $product) {
            $oldPrice = $product->getPrice();
            $newPrice = round(($oldPrice * $value / 100) + $oldPrice, 2);
            if ($newPrice > 0) {
                $product->setPrice($newPrice);
                $productsUpdated++;
            }
        }

        return $productsUpdated;
    }

    /**
     * Update products price with action minus percentage.
     *
     * @param Mage_Catalog_Model_Resource_Product_collection $productsCollection Products collection.
     * @param float                                          $value              Value for update.
     *
     * @return integer
     */
    protected function actionMinusPercentage($productsCollection, $value)
    {
        $productsUpdated = 0;

        foreach ($productsCollection as $product) {
            $oldPrice = $product->getPrice();
            $newPrice = round($oldPrice - ($oldPrice * $value / 100), 2);
            if ($newPrice > 0) {
                $product->setPrice($newPrice);
                $productsUpdated++;
            }
        }

        return $productsUpdated;
    }

    /**
     * Update products price with action multiplication.
     *
     * @param Mage_Catalog_Model_Resource_Product_collection $productsCollection Products collection.
     * @param float                                          $value              Value for update.
     *
     * @return integer
     */
    protected function actionMultiplication($productsCollection, $value)
    {
        $productsUpdated = 0;

        foreach ($productsCollection as $product) {
            $oldPrice = $product->getPrice();
            $newPrice = round($oldPrice * $value, 2);
            if ($newPrice > 0) {
                $product->setPrice($newPrice);
                $productsUpdated++;
            }
        }

        return $productsUpdated;
    }
}