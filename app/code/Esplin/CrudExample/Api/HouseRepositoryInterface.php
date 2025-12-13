<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Esplin\CrudExample\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface HouseRepositoryInterface
{

    /**
     * Save House
     * @param \Esplin\CrudExample\Api\Data\HouseInterface $house
     * @return \Esplin\CrudExample\Api\Data\HouseInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Esplin\CrudExample\Api\Data\HouseInterface $house
    );

    /**
     * Retrieve House
     * @param string $houseId
     * @return \Esplin\CrudExample\Api\Data\HouseInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($houseId);

    /**
     * Retrieve House matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Esplin\CrudExample\Api\Data\HouseSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete House
     * @param \Esplin\CrudExample\Api\Data\HouseInterface $house
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Esplin\CrudExample\Api\Data\HouseInterface $house
    );

    /**
     * Delete House by ID
     * @param string $houseId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($houseId);
}

