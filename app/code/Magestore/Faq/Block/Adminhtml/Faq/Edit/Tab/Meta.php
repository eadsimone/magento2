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
namespace Magestore\Faq\Block\Adminhtml\Faq\Edit\Tab;
/**
 * Class Meta
 * @package Magestore\Faq\Block\Adminhtml\Faq\Edit\Tab
 */
class Meta extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * @var \Magestore\Faq\Model\ResourceModel\Faqvalue\CollectionFactory
     */
    protected $_faqValueCollectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magestore\Faq\Model\ResourceModel\Faqvalue\CollectionFactory $faqValueCollectionFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magestore\Faq\Model\ResourceModel\Faqvalue\CollectionFactory $faqValueCollectionFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    )
    {
        $this->_systemStore = $systemStore;
        $this->_faqValueCollectionFactory = $faqValueCollectionFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout() {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());

        \Magento\Framework\Data\Form::setFieldsetElementRenderer(
            $this->getLayout()->createBlock(
                'Magestore\Faq\Block\Adminhtml\Form\Faq\Renderer\Fieldset\Element',
                $this->getNameInLayout() . '_fieldset_element'
            )
        );
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_faq');
        $isElementDisabled = false;
        $storeViewId = $this->getRequest()->getParam('store');

        $attributesInStore =$this->_faqValueCollectionFactory
            ->create()
            ->addFieldToFilter('faq_id', $model->getCategoryId())
            ->addFieldToFilter('store_id', $storeViewId)
            ->getColumnValues('attribute_code');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('FAQ Information')));

        if ($model->getId()) {
            $fieldset->addField('faq_id', 'hidden', array('name' => 'faq_id'));
        }


        $elements = array();
        $elements['metakeyword']=$fieldset->addField(
            'metakeyword', 'textarea', array(
                'name' => 'metakeyword',
                'required' => false,
                'label' => __('Meta Keyword'),
                'title' => __('Meta Keyword'),
                'disabled' => $isElementDisabled,
            )
        );

        $elements['metadescription']=$fieldset->addField(
            'metadescription', 'textarea', array(
                'name' => 'metadescription',
                'required' => false,
                'label' => __('Meta Description'),
                'title' => __('Meta Description'),
                'disabled' => $isElementDisabled,
            )
        );
        foreach ($attributesInStore as $attribute) {
            $elements[$attribute]->setStoreViewId($storeViewId);
        }
        $this->setForm($form);
        $form->setValues($model->getData());
        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Meta Information');
    }


    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Meta Information');
    }


    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }


    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @param $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

}
