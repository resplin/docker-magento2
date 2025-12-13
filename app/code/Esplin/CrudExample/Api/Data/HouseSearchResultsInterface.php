<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Esplin\CrudExample\Api\Data;

interface HouseSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get House list.
     * @return \Esplin\CrudExample\Api\Data\HouseInterface[]
     */
    public function getItems();

    /**
     * Set room_count list.
     * @param \Esplin\CrudExample\Api\Data\HouseInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

