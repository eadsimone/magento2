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
namespace Magestore\Faq\Model;
/**
 * Class Categoryvalue
 * @package Magestore\Faq\Model
 */
class Categoryvalue extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var ResourceModel\Categoryvalue\CollectionFactory
     */
    protected $_categoryValueCollectionFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel\Categoryvalue $resource
     * @param ResourceModel\Categoryvalue\Collection $resourceCollection
     * @param ResourceModel\Categoryvalue\CollectionFactory $categoryValueCollectionFactory
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magestore\Faq\Model\ResourceModel\Categoryvalue $resource,
        \Magestore\Faq\Model\ResourceModel\Categoryvalue\Collection $resourceCollection,
        \Magestore\Faq\Model\ResourceModel\Categoryvalue\CollectionFactory $categoryValueCollectionFactory
    )
    {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
        $this->_categoryValueCollectionFactory = $categoryValueCollectionFactory;
    }

    /**
     * @param $categoryId
     * @param $storeViewId
     * @param $attributeCode
     * @return $this
     */
    public function loadAttributeValue($categoryId, $storeViewId, $attributeCode)
    {
        $attributeValue = $this->_categoryValueCollectionFactory->create()
            ->addFieldToFilter('category_id', $categoryId)
            ->addFieldToFilter('store_id', $storeViewId)
            ->addFieldToFilter('attribute_code', $attributeCode)
            ->getFirstItem();
        $this->setData('category_id', $categoryId)
            ->setData('store_id', $storeViewId)
            ->setData('attribute_code', $attributeCode);
        if ($attributeValue) {
            $this->addData($attributeValue->getData())
                ->setId($attributeValue->getId());
        }

        return $this;
    }
}
