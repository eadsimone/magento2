<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Faq
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */
namespace Magestore\Faq\Controller\Adminhtml\Category;
/**
 * Class MassStatus
 * @package Magestore\Faq\Controller\Adminhtml\Category
 */
class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * @return $this
     */
    public function execute()
    {
        $categoryIds = $this->getRequest()->getParam('category');
        $status = $this->getRequest()->getParam('status');
        $storeViewId = $this->getRequest()->getParam('store');

        if (!is_array($categoryIds) || empty($categoryIds)) {
            $this->messageManager->addError(__('Please select banner(s).'));
        } else {
            try {
                foreach ($categoryIds as $categoryId) {
                    $category = $this->_objectManager->create('Magestore\Faq\Model\Category')
                        ->setStoreViewId($storeViewId)
                        ->load($categoryId);
                    $category->setStatus($status)
                           ->setIsMassupdate(true)
                           ->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been changed status.', count($categoryIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Faq::category');
    }
}
