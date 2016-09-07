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
namespace Magestore\Faq\Block;
/**
 * Class Overview
 * @package Magestore\Faq\Block
 */
class Overview extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magestore\Faq\Helper\Data
     */
    protected $_faqHelper;
    /**
     * @var \Magestore\Faq\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;
    /**
     * @var \Magestore\Faq\Model\FaqFactory
     */
    protected $_faqFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magestore\Faq\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     * @param \Magestore\Faq\Model\FaqFactory $faqFactory
     * @param \Magestore\Faq\Helper\Data $faqHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magestore\Faq\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magestore\Faq\Model\FaqFactory $faqFactory,
        \Magestore\Faq\Helper\Data $faqHelper,
        array $data = [])
    {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_faqFactory = $faqFactory;
        $this->_faqHelper = $faqHelper;
        parent::__construct($context, $data);
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function _prepareLayout() {
        parent::_prepareLayout();
        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'home',
                [
                    'label' => __('Home'),
                    'title' => __('Home Page'),
                    'link' => $this->_storeManager->getStore()->getBaseUrl()
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'faq',
                [
                    'label' => __('FAQ'),
                    'title' => __('FAQ'),
                    'link' => $this->_storeManager->getStore()->getUrl("faq")
                ]
            );
        }
        $storeId = $this->_storeManager->getStore(true)->getStoreId();
        $faqId =  $this->getRequest()->getParam('id');
        $meta_keywords = $this->_faqHelper->getMetaKeywords();
        $meta_description = $this->_faqHelper->getMetaDescription();
        if($faqId){
            $faq = $this->_faqFactory->create()
                ->setStoreViewId($storeId)->load($faqId);
            $meta_keywords = $faq->getMetakeyword();
            $meta_description = $faq->getMetadescription();
        }
        $this->pageConfig->setDescription($meta_description);
        $this->pageConfig->setKeywords($meta_keywords);
    }

    /**
     * @return $this
     */
    public function getAllCategory() {
        $storeId = $this->_storeManager->getStore(true)->getStoreId();
        $categories =  $this->_categoryCollectionFactory->create()
            ->setStoreViewId($storeId)
            ->addFieldToFilter('status',1);
        $categories->getSelect()->order('CAST(ordering AS SIGNED) ASC');
        $categories ->setOrder('name', 'ASC');
        return $categories;
    }

}