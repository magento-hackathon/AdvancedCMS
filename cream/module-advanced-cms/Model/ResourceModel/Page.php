<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Cream\AdvancedCms\Model\ResourceModel;

/**
 * Cms page mysql resource
 */
class Page extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('advanced_cms_page', 'id');
    }

    /**
     * Process page data before deleting
     *
     * @param \Magento\Framework\Model\AbstractModel $object*
     * @return $this
     */
    protected function _beforeDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        $condition = ['id = ?' => (int)$object->getId()];

        $this->getConnection()->delete($this->getTable('advanced_cms_page'), $condition);

        return parent::_beforeDelete($object);
    }

    /**
     * Retrieves advanced cms page from DB by the passed template id.
     *
     * @param string $templateId
     * @return string|false
     */
    public function getAdvancedCmsPageByTemplateId($templateId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()->from($this->getMainTable(), '*')->where('template_id = :template_id');

        $binds = ['template_id' => (int)$templateId];

        return $connection->fetchOne($select, $binds);
    }

    /**
     * Retrieves advanced cms page from DB by the passed cms id.
     *
     * @param string $cmsId
     * @return string|false
     */
    public function getAdvancedCmsPageByCmsId($cmsId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()->from($this->getMainTable(), '*')->where('cms_id = :cms_id');

        $binds = ['cms_id' => (int)$cmsId];

        return $connection->fetchOne($select, $binds);
    }
}
