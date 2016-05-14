<?php

namespace Cream\AdvancedCms;

use Cream\AdvancedCms\Api\Data;
use Cream\AdvancedCms\Api\TemplateRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Cream\AdvancedCms\Model\ResourceModel\Element as ResourceElement;
use Cream\AdvancedCms\Model\ResourceModel\Element\CollectionFactory as ElementCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ElementRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ElementRepository implements ElementRepositoryInterface
{
    /**
     * @var ResourceElement
     */
    protected $resource;

    /**
     * @var ElementFactory
     */
    protected $elementFactory;

    /**
     * @var ElementCollectionFactory
     */
    protected $elementCollectionFactory;

    /**
     * @var Data\ElementSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \Magento\Cms\Api\Data\ElementInterfaceFactory
     */
    protected $dataElementFactory;

    /**
     * @param ResourceElement $resource
     * @param ElementFactory $elementFactory
     * @param Data\ElementInterfaceFactory $dataElementFactory
     * @param ElementCollectionFactory $elementCollectionFactory
     * @param Data\ElementSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        ResourceElement $resource,
        ElementFactory $elementFactory,
        Data\ElementInterfaceFactory $dataElementFactory,
        ElementCollectionFactory $elementCollectionFactory,
        Data\ElementSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->resource = $resource;
        $this->elementFactory = $elementFactory;
        $this->elementCollectionFactory = $elementCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataelementFactory = $dataElementFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * Save Element data
     *
     * @param \Cream\AdvancedCms\Api\Data\ElementInterface $element
     * @return Element
     * @throws CouldNotSaveException
     */
    public function save(\Cream\AdvancedCms\Api\Data\ElementInterface $element)
    {
        try {
            $this->resource->save($element);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $element;
    }

    /**
     * Load Element data by given Element Identity
     *
     * @param string $elementId
     * @return Element
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($elementId)
    {
        $element = $this->elementFactory->create();
        $element->load($elementId);
        if (!$element->getId()) {
            throw new NoSuchEntityException(__('CMS Element with id "%1" does not exist.', $elementId));
        }
        return $element;
    }

    /**
     * Load Element data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Cream\AdvancedCms\Model\ResourceModel\Element\Collection
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->elementCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $elements = [];
        /** @var Element $elementModel */
        foreach ($collection as $elementModel) {
            $elementData = $this->dataElementFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $elementData,
                $elementModel->getData(),
                'Cream\AdvancedCms\Api\Data\ElementInterface'
            );
            $elements[] = $this->dataObjectProcessor->buildOutputDataArray(
                $elementData,
                'Cream\AdvancedCms\Api\Data\ElementInterface'
            );
        }
        $searchResults->setItems($elements);
        return $searchResults;
    }

    /**
     * Delete Element
     *
     * @param \Cream\AdvancedCms\Api\Data\ElementInterface $element
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Cream\AdvancedCms\Api\Data\ElementInterface $element)
    {
        try {
            $this->resource->delete($element);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Element by given Element Identity
     *
     * @param string $elementId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($elementId)
    {
        return $this->delete($this->getById($elementId));
    }
}
