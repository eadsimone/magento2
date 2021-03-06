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
namespace Magestore\Faq\Controller\Adminhtml\Faq;
/**
 * Class MassStatus
 * @package Magestore\Faq\Controller\Adminhtml\Faq
 */
class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * @return $this
     */
    public function execute()
    {
        $faqIds = $this->getRequest()->getParam('faq');
        $status = $this->getRequest()->getParam('status');
        $storeViewId = $this->getRequest()->getParam('store');

        if (!is_array($faqIds) || empty($faqIds)) {
            $this->messageManager->addError(__('Please select faq(s).'));
        } else {
            try {
                foreach ($faqIds as $faqId) {
                    $faq = $this->_objectManager->create('Magestore\Faq\Model\Faq')
                        ->setStoreViewId($storeViewId)
                        ->load($faqId);
                    $faq->setStatus($status)
                           ->setIsMassupdate(true)
                           ->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been changed status.', count($faqIds))
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
        return $this->_authorization->isAllowed('Magestore_Faq::faq_faq');
    }
}
