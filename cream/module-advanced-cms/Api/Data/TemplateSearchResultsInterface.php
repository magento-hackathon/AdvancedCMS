<?php

namespace Cream\AdvancedCms\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for cms page search results.
 * @api
 */
interface TemplateSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get pages list.
     *
     * @return \Cream\AdvancedCms\Api\Data\TemplateInterface[]
     */
    public function getItems();

    /**
     * Set pages list.
     *
     * @param \Cream\AdvancedCms\Api\Data\TemplateInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
