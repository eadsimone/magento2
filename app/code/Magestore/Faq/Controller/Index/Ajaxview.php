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
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Ajaxview
 * @package Magestore\Faq\Controller\Index
 */
class Ajaxview extends \Magento\Framework\App\Action\Action
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
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context
    )
    {
        parent::__construct($context);
        $this->resultFactory = $context->getResultFactory();
    }

    /**
     *
     */
    public function execute()
    {
        $resultLayout = $this->resultFactory->create(ResultFactory::TYPE_LAYOUT);
        $block = $resultLayout->getLayout()->createBlock('Magestore\Faq\Block\Listfaq')
            ->setTemplate('list.phtml')->toHtml();
        echo $block;
    }
}
