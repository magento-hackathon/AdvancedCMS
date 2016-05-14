<?php

namespace Cream\AdvancedCms\Model\ResourceModel\Template;

use \Cream\AdvancedCms\Model\ResourceModel\AbstractCollection;

/**
 * CMS template collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Cream\AdvancedCms\Model\Template', 'Cream\AdvancedCms\Model\ResourceModel\Template');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
