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
namespace Magestore\Faq\Block\Adminhtml\Faq\Edit;
/**
 * Class Tabs
 * @package Magestore\Faq\Block\Adminhtml\Faq\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('faq_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('FAQ Information'));
    }

    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'faq_faq_form',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock('Magestore\Faq\Block\Adminhtml\Faq\Edit\Tab\Form')->toHtml(),
                'active' => true
            ]
        );
        $this->addTab(
            'faq_faq_meta',
            [
                'label' => __('Meta Information'),
                'title' => __('Meta Information'),
                'content' => $this->getLayout()->createBlock('Magestore\Faq\Block\Adminhtml\Faq\Edit\Tab\Meta')->toHtml(),
                'active' => false
            ]
        );

        return parent::_beforeToHtml();
    }

}
