<?php

namespace Cream\AdvancedCms\Api\Data;

/**
 * CMS page interface.
 * @api
 */
interface PageInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const CMS_ID                  = 'cms_id';
    const TEMPLATE_ID             = 'template_id';

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
     * Set ID
     *
     * @param int $id
     * @return \Cream\AdvancedCms\Api\Data\PageInterface
     */
    public function setId($id);

    /**
     * Set template id
     *
     * @param string $templateId
     * @return \Cream\AdvancedCms\Api\Data\PageInterface
     */
    public function setTemplateId($templateId);
}
