<?php

namespace Cream\AdvancedCms\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * CMS page CRUD interface.
 * @api
 */
interface ElementRepositoryInterface
{
    /**
     * Save page.
     *
     * @param \Cream\AdvancedCms\Api\Data\ElementInterface $element
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Cream\AdvancedCms\Api\Data\ElementInterface $element);

    /**
     * Retrieve element.
     *
     * @param int $elementId
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($elementId);

    /**
     * Retrieve pages matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Cream\AdvancedCms\Api\Data\ElementSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete element.
     *
     * @param \Cream\AdvancedCms\Api\Data\ElementInterface $element
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Cream\AdvancedCms\Api\Data\ElementInterface $element);

    /**
     * Delete element by ID.
     *
     * @param int $elementId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($elementId);
}
