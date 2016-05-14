<?php

namespace Cream\AdvancedCms\Api\Data;

/**
 * CMS page interface.
 * @api
 */
interface ElementInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID          = 'entity_id';
    const TEMPLATE_ID = 'template_id';
    const NAME        = 'name';
    const TYPE        = 'type';

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
    public function getTemplateId();

    /**
     * Get name
     *
     * @return varchar
     */
    public function getName();

    /**
     * Get type
     *
     * @return varchar
     */
    public function getType();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setId($id);

    /**
     * Set template id
     *
     * @param int $templateId
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setTemplateId($templateId);

    /**
     * Set name
     *
     * @param string $name
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setName($name);

    /**
     * Set type
     *
     * @param int $type
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     */
    public function setType($type);
}
