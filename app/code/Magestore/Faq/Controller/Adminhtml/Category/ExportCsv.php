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
namespace Magestore\Faq\Controller\Adminhtml\Category;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class ExportCsv
 * @package Magestore\Faq\Controller\Adminhtml\Category
 */
class ExportCsv extends \Magento\Backend\App\Action {
	/**
	 * @var \Magento\Framework\App\Response\Http\FileFactory
     */
	protected $_fileFactory;
	/**
	 * @var \Magento\Framework\View\Result\LayoutFactory
     */
	protected $resultLayoutFactory;

	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
	 * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
		\Magento\Framework\App\Response\Http\FileFactory $fileFactory
	) {
        $this->_fileFactory = $fileFactory;
        parent::__construct($context);
        $this->resultLayoutFactory = $resultLayoutFactory;
	}

	/**
	 * @return \Magento\Framework\App\ResponseInterface
	 * @throws \Exception
     */
	public function execute() {
		$fileName = 'categories.csv';
		$exportBlock = $this->resultLayoutFactory->create()
			->getLayout()->createBlock('Magestore\Faq\Block\Adminhtml\Category\Grid');
		return $this->_fileFactory->create(
			$fileName,
			$exportBlock->getCsvFile(),
			DirectoryList::VAR_DIR
		);
	}

	/**
	 * @return bool
     */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Magestore_Faq::category');
	}
}
