<?php
namespace Esplin\StockDoctor\Controller\Adminhtml\Action;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Esplin\StockDoctor\Model\StockDoctorService;
use Esplin\StockDoctor\Model\ResourceModel\Inconsistency\CollectionFactory;

class FixSelected extends Action
{
    const ADMIN_RESOURCE = 'Esplin_StockDoctor::manage';

    private StockDoctorService $stockDoctorService;
    private CollectionFactory $collectionFactory;

    public function __construct(
        Context $context,
        StockDoctorService $stockDoctorService,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->stockDoctorService = $stockDoctorService;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(): Redirect
    {
        $ids = $this->getRequest()->getParam('selected', []);

        if (!empty($ids)) {
            $collection = $this->collectionFactory->create()
                ->addFieldToFilter('entity_id', ['in' => $ids]);

            foreach ($collection as $row) {
                $this->stockDoctorService->fixReservation($row->getSku(), (int)$row->getStockId());
            }

            $this->messageManager->addSuccessMessage(__('Selected inconsistencies have been fixed.'));
        } else {
            $this->messageManager->addErrorMessage(__('No inconsistencies were selected.'));
        }

        return $this->resultRedirectFactory->create()->setPath('stockdoctor/inconsistency/index');
    }
}
