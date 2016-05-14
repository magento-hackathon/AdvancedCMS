<?php

namespace Cream\AdvancedCms\Controller\Adminhtml\Template;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('Templates'));

        return $resultPage;
    }
}