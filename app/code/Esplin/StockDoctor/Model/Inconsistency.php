<?php
namespace Esplin\StockDoctor\Model;

use Magento\Framework\Model\AbstractModel;

class Inconsistency extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Inconsistency::class);
    }
}
