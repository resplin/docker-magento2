<?php
namespace Esplin\StockDoctor\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Esplin\StockDoctor\Model\ResourceModel\Inconsistency\CollectionFactory;

class InconsistencyDataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
}
