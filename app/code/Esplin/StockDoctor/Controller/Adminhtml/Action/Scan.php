<?php
namespace Esplin\StockDoctor\Controller\Adminhtml\Action;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Esplin\StockDoctor\Model\StockDoctorService;

class Scan extends Action
{
    const ADMIN_RESOURCE = 'Esplin_StockDoctor::manage';

    private StockDoctorService $stockDoctorService;

    public function __construct(
        Context $context,
        StockDoctorService $stockDoctorService
    ) {
        parent::__construct($context);
        $this->stockDoctorService = $stockDoctorService;
    }

    public function execute(): Redirect
    {
        $inconsistencies = $this->stockDoctorService->scan();

        $this->messageManager->addSuccessMessage(
            __('Scan completed, %1 inconsistencies found', count($inconsistencies))
        );

        return $this->resultRedirectFactory->create()->setPath('stockdoctor/dashboard/index');
    }
}
