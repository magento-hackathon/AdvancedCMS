<?php

namespace Cream\AdvancedCms\Api\Data;

/**
 * CMS page interface.
 * @api
 */
interface TemplateInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID   = 'entity_id';
    const NAME = 'name';

    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get template id
     *
     * @return int|null
     */
    public function getName();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Cream\AdvancedCms\Api\Data\TemplateInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     * @return \Cream\AdvancedCms\Api\Data\TemplateInterface
     */
    public function setName($name);
}
