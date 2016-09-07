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
 * Class MassDelete
 * @package Magestore\Faq\Controller\Adminhtml\Category
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magestore\Faq\Model\CategoryFactory $categoryFactory
     * @param \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magestore\Faq\Model\CategoryFactory $categoryFactory,
        \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory
    )
    {
        parent::__construct($context);
        $this->_categoryFactory = $categoryFactory;
        $this->_faqCollectionFactory = $faqCollectionFactory;
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $categoryIds = $this->getRequest()->getParam('category');
        if (!is_array($categoryIds) || empty($categoryIds)) {
            $this->messageManager->addError(__('Please select category(s).'));
        } else {
            $count = 0;
            try {
                foreach ($categoryIds as $categoryId) {
                    $category = $this->_objectManager->create('Magestore\Faq\Model\Category')
                        ->load($categoryId);
                    $questions = $this->_faqCollectionFactory->create()
                        ->addFieldToFilter('category_id', $categoryId);
                    if (!$questions->getsize()) {
                        $category->delete();
                        $count++;
                    } else {
                        $this->messageManager->addError(__('Cannot delete Category "%1" that contained FAQs', $category->getName()));
                    }
                }
                if ($count) {
                    $this->messageManager->addSuccess(
                        __('Total of %d record(s) were successfully deleted', $count)
                    );
                }
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
