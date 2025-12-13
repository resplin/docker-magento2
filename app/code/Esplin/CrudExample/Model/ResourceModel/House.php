<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Esplin\CrudExample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class House extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('esplin_crudexample_house', 'house_id');
    }
}

