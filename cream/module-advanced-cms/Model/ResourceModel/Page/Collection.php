<?php

namespace Cream\AdvancedCms\Model\ResourceModel\Page;

use \Cream\AdvancedCms\Model\ResourceModel\AbstractCollection;

/**
 * CMS page collection
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
        $this->_init('Cream\AdvancedCms\Model\Page', 'Cream\AdvancedCms\Model\ResourceModel\Page');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
