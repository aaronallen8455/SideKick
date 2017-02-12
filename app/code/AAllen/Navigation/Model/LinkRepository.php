<?php


namespace AAllen\Navigation\Model;

use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use AAllen\Navigation\Api\Data\LinkInterfaceFactory;
use AAllen\Navigation\Api\LinkRepositoryInterface;
use AAllen\Navigation\Model\ResourceModel\Link\CollectionFactory as LinkCollectionFactory;
use AAllen\Navigation\Api\Data\LinkSearchResultsInterfaceFactory;
use AAllen\Navigation\Model\ResourceModel\Link as ResourceLink;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

class LinkRepository implements LinkRepositoryInterface
{

    private $storeManager;

    protected $dataLinkFactory;

    protected $dataObjectProcessor;

    protected $LinkFactory;

    protected $resource;

    protected $dataObjectHelper;

    protected $LinkCollectionFactory;

    protected $searchResultsFactory;


    /**
     * @param ResourceLink $resource
     * @param LinkFactory $linkFactory
     * @param LinkInterfaceFactory $dataLinkFactory
     * @param LinkCollectionFactory $linkCollectionFactory
     * @param LinkSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceLink $resource,
        LinkFactory $linkFactory,
        LinkInterfaceFactory $dataLinkFactory,
        LinkCollectionFactory $linkCollectionFactory,
        LinkSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->linkFactory = $linkFactory;
        $this->linkCollectionFactory = $linkCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLinkFactory = $dataLinkFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \AAllen\Navigation\Api\Data\LinkInterface $link
    ) {
        /* if (empty($link->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $link->setStoreId($storeId);
        } */
        try {
            $this->resource->save($link);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the link: %1',
                $exception->getMessage()
            ));
        }
        return $link;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($linkId)
    {
        $link = $this->linkFactory->create();
        $link->load($linkId);
        if (!$link->getId()) {
            throw new NoSuchEntityException(__('Link with id "%1" does not exist.', $linkId));
        }
        return $link;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection = $this->linkCollectionFactory->create();
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
        $items = [];
        
        foreach ($collection as $linkModel) {
            $linkData = $this->dataLinkFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $linkData,
                $linkModel->getData(),
                'AAllen\Navigation\Api\Data\LinkInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $linkData,
                'AAllen\Navigation\Api\Data\LinkInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \AAllen\Navigation\Api\Data\LinkInterface $link
    ) {
        try {
            $this->resource->delete($link);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Link: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($linkId)
    {
        return $this->delete($this->getById($linkId));
    }
}
