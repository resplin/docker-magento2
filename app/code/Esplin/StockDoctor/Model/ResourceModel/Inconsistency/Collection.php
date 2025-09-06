<?php
namespace Esplin\StockDoctor\Model\ResourceModel\Inconsistency;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Esplin\StockDoctor\Model\Inconsistency;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Inconsistency::class, \Esplin\StockDoctor\Model\ResourceModel\Inconsistency::class);
    }
}
