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
namespace Magestore\Faq\Model\Config\Source;
/**
 * Class Listposition
 * @package Magestore\Faq\Model\Config\Source
 */
class Listposition implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $positionArray = array(
            array('value' => 'sidebar-right', 'label' => __('Right sidebar')),
            array('value' => 'sidebar-left', 'label' => __('Left sidebar')),
        );
        return $positionArray;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $positionArray = array(
            'sidebar-right' => __('Right sidebar'),
            'sidebar-left' => __('Left sidebar'),
        );
        return $positionArray;
    }
}
