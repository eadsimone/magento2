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
 * Class Tag
 * @package Magestore\Faq\Block
 */
class Tag extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory
     */
    protected $_faqCollectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magestore\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        array $data = [])
    {
        $this->_faqCollectionFactory = $faqCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     *
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
    }

    /**
     * @return array
     */
    public function getAllTags(){
        $faqCollection= $this->_faqCollectionFactory->create()
            ->setStoreViewId($this->_storeManager->getStore(true)->getStoreId())
            ->addFieldToFilter('status',1)
            ;
        $tagArray = array();
        foreach ($faqCollection as $faq) {
            $tag = $faq->getTag();
            $tagArrayFaq = explode(',',$tag);
            foreach ($tagArrayFaq as $oneTag) {
                $oneTag = trim($oneTag);
                if ($oneTag && !in_array($oneTag,$tagArray)) {
                    $tagArray[] = $oneTag;
                }
            }
        }
        return $tagArray;
    }


}