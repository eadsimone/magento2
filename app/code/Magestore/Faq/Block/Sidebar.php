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
 * Class Sidebar
 * @package Magestore\Faq\Block
 */
class Sidebar extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magestore\Faq\Helper\Data
     */
    protected $_faqHelper;
    /**
     * @var \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory
     */
    protected $_faqCollectionFactory;
    /**
     * @var \Magestore\Faq\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magestore\Faq\Helper\Data $helperData
     * @param \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory
     * @param \Magestore\Faq\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magestore\Faq\Helper\Data $helperData,
        \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        \Magestore\Faq\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        array $data = [])
    {
        $this->_faqHelper = $helperData;
        $this->_faqCollectionFactory = $faqCollectionFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getSidebarPosition() {
        $sidebarPosition = $this->_faqHelper->getSidebarPosition();
        return $sidebarPosition;
    }

    /**
     * @return $this
     */
    public function getMostFrequently()
    {
        $page_size =$this->_faqHelper->getSidebarQuestionNumber();

        if($page_size==0) $page_size =5;
        $most_frequently = $this->_faqCollectionFactory->create()
            ->setStoreViewId($this->_faqHelper->getStoreId())
            ->addFieldToFilter('most_frequently',1)
            ->addFieldToFilter('status',1)
            ->setOrder('ordering', 'ASC')
            ->setOrder('title', 'ASC')
            ->setOrder('update_time', 'DESC');
        $most_frequently->setPageSize($page_size);
        return $most_frequently;
    }

    /**
     * @return string
     */
    public function getFaqUrl()
    {
        return $this->getUrl('faq/index/index');
    }

}