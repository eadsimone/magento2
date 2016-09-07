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
namespace Magestore\Faq\Model\ResourceModel;
/**
 * Class Faq
 * @package Magestore\Faq\Model\ResourceModel
 */
class Faq extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime $dateTime
     * @param null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->dateTime = $dateTime;
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('faq', 'faq_id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $faq
     * @return $this
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $faq)
    {
        if ($faq->isObjectNew()) {
            $faq->setCreatedTime($this->dateTime->formatDate(true));
        }
        $faq->setUpdateTime($this->dateTime->formatDate(true));

        return parent::_beforeSave($faq);
    }
}
