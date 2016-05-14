<?php

namespace Cream\AdvancedCms\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * CMS page CRUD interface.
 * @api
 */
interface TemplateRepositoryInterface
{
    /**
     * Save page.
     *
     * @param \Cream\AdvancedCms\Api\Data\TemplateInterface $template
     * @return \Cream\AdvancedCms\Api\Data\TemplateInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Cream\AdvancedCms\Api\Data\TemplateInterface $template);

    /**
     * Retrieve page.
     *
     * @param int $templateId
     * @return \Cream\AdvancedCms\Api\Data\TemplateInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($templateId);

    /**
     * Retrieve pages matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Cream\AdvancedCms\Api\Data\PageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete template.
     *
     * @param \Cream\AdvancedCms\Api\Data\TemplateInterface $template
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Cream\AdvancedCms\Api\Data\TemplateInterface $template);

    /**
     * Delete template by ID.
     *
     * @param int $templateId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($templateId);
}
