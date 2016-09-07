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
namespace Magestore\Faq\Controller\Index;
/**
 * Class Index
 * @package Magestore\Faq\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var
     */
    protected $storeManager;
    /**
     * @var
     */
    protected $_registry;
    /**
     * @var
     */
    protected $_categoryFactory;
    /**
     * @var \Magestore\Faq\Helper\Data
     */
    protected $_faqHelper;
    /**
     * @var
     */
    protected $_faqFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magestore\Faq\Helper\Data $helperData
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magestore\Faq\Helper\Data $helperData
    )
    {
        parent::__construct($context);
        $this->_faqHelper = $helperData;
    }

    /**
     * @return $this|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $faqId =  $this->getRequest()->getParam('id');
        $status = 1;
        if ($faqId) {
            $faqModel = $this->_objectManager->create('Magestore\Faq\Model\Faq')->load($faqId);
            if ($faqModel) {
                if ($faqModel->getFaqId()) {
                    $status = $faqModel->getStatus();
                }
            }
        }
        if( $this->_faqHelper->isEnableConfig() && $status==1) {
            $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
            return $resultPage;
        } else {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('cms/index/noRoute');
        }
    }
}
