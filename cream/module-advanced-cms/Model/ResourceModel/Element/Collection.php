<?php

namespace Cream\AdvancedCms\Model\ResourceModel\Element;

use \Cream\AdvancedCms\Model\ResourceModel\AbstractCollection;

/**
 * Advanced cms element collection
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
        $this->_init('Cream\AdvancedCms\Model\Element', 'Cream\AdvancedCms\Model\ResourceModel\Element');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
