<?php

// @codingStandardsIgnoreFile

namespace Cream\AdvancedCms\Model\ResourceModel;

/**
 * Cms template mysql resource
 */
class Element extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('advanced_cms_element', 'id');
    }

    /**
     * Process template data before deleting
     *
     * @param \Magento\Framework\Model\AbstractModel $object*
     * @return $this
     */
    protected function _beforeDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        $condition = ['id = ?' => (int)$object->getId()];

        $this->getConnection()->delete($this->getTable('advanced_cms_element'), $condition);

        return parent::_beforeDelete($object);
    }

    /**
     * Retrieves advanced cms template from DB by the passed template id.
     *
     * @param string $templateId
     * @return string|false
     */
    public function getAdvancedCmsElementByTemplateId($templateId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()->from($this->getMainTable(), '*')->where('template_id = :template_id');

        $binds = ['template_id' => (int)$templateId];

        return $connection->fetchOne($select, $binds);
    }
}
