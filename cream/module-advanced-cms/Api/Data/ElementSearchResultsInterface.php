<?php

namespace Cream\AdvancedCms\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for cms page search results.
 * @api
 */
interface ElementSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get pages list.
     *
     * @return \Cream\AdvancedCms\Api\Data\ElementInterface[]
     */
    public function getItems();

    /**
     * Set pages list.
     *
     * @param \Cream\AdvancedCms\Api\Data\ElementInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
