<?php

namespace Cream\AdvancedCms\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for cms page search results.
 * @api
 */
interface PageSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get pages list.
     *
     * @return \Cream\AdvancedCms\Api\Data\PageInterface[]
     */
    public function getItems();

    /**
     * Set pages list.
     *
     * @param \Cream\AdvancedCms\Api\Data\PageInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
