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
    const ID          = 'entity_id';
    const CMS_ID      = 'cms_id';
    const TEMPLATE_ID = 'template_id';

    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get cms id
     *
     * @return int|null
     */
    public function getCmsId();

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
     * Set cms id
     *
     * @param int $cmsId
     * @return \Cream\AdvancedCms\Api\Data\PageInterface
     */
    public function setCmsId($cmsId);

    /**
     * Set template id
     *
     * @param int $templateId
     * @return \Cream\AdvancedCms\Api\Data\PageInterface
     */
    public function setTemplateId($templateId);
}
