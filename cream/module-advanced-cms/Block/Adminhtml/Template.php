<?php

namespace Cream\AdvancedCms\Block\Adminhtml;

class Template extends \Magento\Backend\Block\Widget\Grid\Container
{
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_blockGroup = 'Cream_AdvancedCms';
        $this->_controller = 'adminhtml_template';

        parent::__construct($context, $data);

//        $this->removeButton('add');
    }

    /**
     * Get the url for a button
     *
     * @param $url string
     * @return string
     */
    protected function _getButtonUrl($url, $params = array()) {
        //Example ('*/*/new')
        return $this->getUrl($url, $params);
    }

    /**
     * Get the label for a button
     *
     * @param $label string
     * @return string
     */
    protected function _getButtonLabel($label) {
        //Example ('Add New')
        return __($label);
    }
}