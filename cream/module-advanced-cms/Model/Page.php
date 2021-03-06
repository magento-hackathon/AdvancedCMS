<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Cream\AdvancedCms\Model;

use Cream\AdvancedCms\Api\Data\PageInterface;

/**
 * AdvancedCms Page Model
 *
 * @method \Cream\AdvancedCms\Model\ResourceModel\Page _getResource()
 * @method \Cream\AdvancedCms\Model\ResourceModel\Page getResource()
 */
class Page extends \Magento\Framework\Model\AbstractModel implements PageInterface
{
    /**
     * No route page id
     */
    const NOROUTE_PAGE_ID = 'no-route';

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'advanced_cms_page';

    /**
     * @var string
     */
    protected $_cacheTag = 'advanced_cms_page';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'advanced_cms_page';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cream\AdvancedCms\Model\ResourceModel\Page');
    }

    /**
     * Load object data
     *
     * @param int|null $id
     * @param string $field
     * @return $this
     */
    public function load($id, $field = null)
    {
        if ($id === null) {
            return $this->noRoutePage();
        }
        return parent::load($id, $field);
    }

    /**
     * Load No-Route Page
     *
     * @return \Magento\Cms\Model\Page
     */
    public function noRoutePage()
    {
        return $this->load(self::NOROUTE_PAGE_ID, $this->getIdFieldName());
    }

    /**
     * Get cms id
     *
     * @return string
     */
    public function getCmsId()
    {
        return $this->getData(self::CMS_ID);
    }

    /**
     * Get template id
     *
     * @return int
     */
    public function getTemplateId()
    {
        return parent::getData(self::TEMPLATE_ID);
    }

    /**
     * Set cms id
     *
     * @param int $cmsId
     * @return \Cream\AdvancedCms\Api\Data\PageInterface
     */
    public function setCmsId($cmsId)
    {
        return $this->setData(self::CMS_ID, $cmsId);
    }

    /**
     * Set template id
     *
     * @param string $templateId
     * @return \Cream\AdvancedCms\Api\Data\PageInterface
     */
    public function setTemplateId($templateId)
    {
        return $this->setData(self::TEMPLATE_ID, $templateId);
    }
}
