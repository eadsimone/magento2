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
 * Class Leftsidebar
 * @package Magestore\Faq\Block
 */
class Leftsidebar extends \Magestore\Faq\Block\Sidebar
{
    /**
     * @return $this
     */
    protected function _prepareLayout() {
        $isActive =  $this->_faqHelper->isEnableConfig();
        if ($this->_faqHelper->getSidebarPosition()=='sidebar-left'&& $isActive &&
            $this->_faqHelper->isShowSidebar()==1 ) {
            $this->setTemplate('sidebar.phtml');
        }
        return parent::_prepareLayout(); // TODO: Change the autogenerated stub
    }
}