<?php

namespace Cream\AdvancedCms\Model;

use Cream\AdvancedCms\Api\Data\ElementInterface;

/**
 * AdvancedCms Element Model
 *
 * @method \Cream\AdvancedCms\Model\ResourceModel\Element _getResource()
 * @method \Cream\AdvancedCms\Model\ResourceModel\Element getResource()
 */
class Element extends \Magento\Framework\Model\AbstractModel implements ElementInterface
{
    /**
     * No route element id
     */
    const NOROUTE_PAGE_ID = 'no-route';

    /**
     * CMS element cache tag
     */
    const CACHE_TAG = 'advanced_cms_element';

    /**
     * @var string
     */
    protected $_cacheTag = 'advanced_cms_element';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'advanced_cms_element';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cream\AdvancedCms\Model\ResourceModel\Element');
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
     * @return \Cream\AdvancedCms\Model\Element
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
    public function getName()
    {
        return $this->getData(self::NAME);
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
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return parent::getData(self::TYPE);
    }

    /**
     * Set cms id
     *
     * @param int $cmsId
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setCmsId($cmsId)
    {
        return $this->setData(self::CMS_ID, $cmsId);
    }

    /**
     * Set template id
     *
     * @param int $templateId
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setTemplateId($templateId)
    {
        return $this->setData(self::TEMPLATE_ID, $templateId);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set type
     *
     * @param string $type
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }
}
