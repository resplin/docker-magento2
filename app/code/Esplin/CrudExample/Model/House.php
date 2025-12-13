<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Esplin\CrudExample\Model;

use Esplin\CrudExample\Api\Data\HouseInterface;
use Magento\Framework\Model\AbstractModel;

class House extends AbstractModel implements HouseInterface
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(\Esplin\CrudExample\Model\ResourceModel\House::class);
    }

    /**
     * @inheritDoc
     */
    public function getHouseId()
    {
        return $this->getData(self::HOUSE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setHouseId($houseId)
    {
        return $this->setData(self::HOUSE_ID, $houseId);
    }

    /**
     * @inheritDoc
     */
    public function getRoomCount()
    {
        return $this->getData(self::ROOM_COUNT);
    }

    /**
     * @inheritDoc
     */
    public function setRoomCount($roomCount)
    {
        return $this->setData(self::ROOM_COUNT, $roomCount);
    }
}

