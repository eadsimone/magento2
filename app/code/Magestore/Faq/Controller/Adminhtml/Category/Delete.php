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
 * Class Delete
 * @package Magestore\Faq\Controller\Adminhtml\Category
 */
class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magestore\Faq\Model\CategoryFactory
     */
    protected $_categoryFactory;
    /**
     * @var \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory
     */
    protected $_faqCollectionFactory;

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
        $resultRedirect = $this->resultRedirectFactory->create();
        $categoryId = $this->getRequest()->getParam('id');
        if ($categoryId > 0) {
            try {
                $categoryModel = $this->_categoryFactory->create()->load($this->getRequest()->getParam('id'));
                $questions =  $this->_faqCollectionFactory->create()->addFieldToFilter('category_id', $categoryId);
                if (!$questions->getsize()) {
                    $categoryModel->delete();
                    $this->messageManager->addSuccess(__('Category was successfully deleted'));
                } else {
                    $this->messageManager->addError(__('Cannot delete Category that contained FAQs'));
                }

            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['_current' => true]);
            }
        }
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
