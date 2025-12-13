<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Esplin\CrudExample\Api\Data;

interface HouseInterface
{

    const ROOM_COUNT = 'room_count';
    const HOUSE_ID = 'house_id';

    /**
     * Get house_id
     * @return string|null
     */
    public function getHouseId();

    /**
     * Set house_id
     * @param string $houseId
     * @return \Esplin\CrudExample\House\Api\Data\HouseInterface
     */
    public function setHouseId($houseId);

    /**
     * Get room_count
     * @return string|null
     */
    public function getRoomCount();

    /**
     * Set room_count
     * @param string $roomCount
     * @return \Esplin\CrudExample\House\Api\Data\HouseInterface
     */
    public function setRoomCount($roomCount);
}

