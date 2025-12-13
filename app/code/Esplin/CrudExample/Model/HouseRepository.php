<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Esplin\CrudExample\Model;

use Esplin\CrudExample\Api\Data\HouseInterface;
use Esplin\CrudExample\Api\Data\HouseInterfaceFactory;
use Esplin\CrudExample\Api\Data\HouseSearchResultsInterfaceFactory;
use Esplin\CrudExample\Api\HouseRepositoryInterface;
use Esplin\CrudExample\Model\ResourceModel\House as ResourceHouse;
use Esplin\CrudExample\Model\ResourceModel\House\CollectionFactory as HouseCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class HouseRepository implements HouseRepositoryInterface
{

    /**
     * @var ResourceHouse
     */
    protected $resource;

    /**
     * @var HouseInterfaceFactory
     */
    protected $houseFactory;

    /**
     * @var HouseCollectionFactory
     */
    protected $houseCollectionFactory;

    /**
     * @var House
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceHouse $resource
     * @param HouseInterfaceFactory $houseFactory
     * @param HouseCollectionFactory $houseCollectionFactory
     * @param HouseSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceHouse $resource,
        HouseInterfaceFactory $houseFactory,
        HouseCollectionFactory $houseCollectionFactory,
        HouseSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->houseFactory = $houseFactory;
        $this->houseCollectionFactory = $houseCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(HouseInterface $house)
    {
        try {
            $this->resource->save($house);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the house: %1',
                $exception->getMessage()
            ));
        }
        return $house;
    }

    /**
     * @inheritDoc
     */
    public function get($houseId)
    {
        $house = $this->houseFactory->create();
        $this->resource->load($house, $houseId);
        if (!$house->getId()) {
            throw new NoSuchEntityException(__('House with id "%1" does not exist.', $houseId));
        }
        return $house;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->houseCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(HouseInterface $house)
    {
        try {
            $houseModel = $this->houseFactory->create();
            $this->resource->load($houseModel, $house->getHouseId());
            $this->resource->delete($houseModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the House: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($houseId)
    {
        return $this->delete($this->get($houseId));
    }
}

