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
use Cream\AdvancedCms\Model\ResourceModel\Template as ResourceTemplate;
use Cream\AdvancedCms\Model\ResourceModel\Template\CollectionFactory as TemplateCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class TemplateRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class TemplateRepository implements TemplateRepositoryInterface
{
    /**
     * @var ResourceTemplate
     */
    protected $resource;

    /**
     * @var TemplateFactory
     */
    protected $templateFactory;

    /**
     * @var TemplateCollectionFactory
     */
    protected $templateCollectionFactory;

    /**
     * @var Data\TemplateSearchResultsInterfaceFactory
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
     * @var \Magento\Cms\Api\Data\TemplateInterfaceFactory
     */
    protected $dataTemplateFactory;

    /**
     * @param ResourceTemplate $resource
     * @param TemplateFactory $templateFactory
     * @param Data\TemplateInterfaceFactory $dataTemplateFactory
     * @param TemplateCollectionFactory $templateCollectionFactory
     * @param Data\TemplateSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        ResourceTemplate $resource,
        TemplateFactory $templateFactory,
        Data\TemplateInterfaceFactory $dataTemplateFactory,
        TemplateCollectionFactory $templateCollectionFactory,
        Data\TemplateSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->resource = $resource;
        $this->templateFactory = $templateFactory;
        $this->templateCollectionFactory = $templateCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->datatemplateFactory = $dataTemplateFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * Save Template data
     *
     * @param \Cream\AdvancedCms\Api\Data\TemplateInterface $template
     * @return Template
     * @throws CouldNotSaveException
     */
    public function save(\Cream\AdvancedCms\Api\Data\TemplateInterface $template)
    {
        try {
            $this->resource->save($template);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $template;
    }

    /**
     * Load Template data by given Template Identity
     *
     * @param string $templateId
     * @return Template
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($templateId)
    {
        $template = $this->templateFactory->create();
        $template->load($templateId);
        if (!$template->getId()) {
            throw new NoSuchEntityException(__('CMS Template with id "%1" does not exist.', $templateId));
        }
        return $template;
    }

    /**
     * Load Template data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Cream\AdvancedCms\Model\ResourceModel\Template\Collection
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->templateCollectionFactory->create();
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
        $templates = [];
        /** @var Template $templateModel */
        foreach ($collection as $templateModel) {
            $templateData = $this->dataTemplateFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $templateData,
                $templateModel->getData(),
                'Cream\AdvancedCms\Api\Data\TemplateInterface'
            );
            $templates[] = $this->dataObjectProcessor->buildOutputDataArray(
                $templateData,
                'Cream\AdvancedCms\Api\Data\TemplateInterface'
            );
        }
        $searchResults->setItems($templates);
        return $searchResults;
    }

    /**
     * Delete Template
     *
     * @param \Cream\AdvancedCms\Api\Data\TemplateInterface $template
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Cream\AdvancedCms\Api\Data\TemplateInterface $template)
    {
        try {
            $this->resource->delete($template);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Template by given Template Identity
     *
     * @param string $templateId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($templateId)
    {
        return $this->delete($this->getById($templateId));
    }
}
