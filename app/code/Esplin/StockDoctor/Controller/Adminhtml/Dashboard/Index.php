<?php
namespace Esplin\StockDoctor\Controller\Adminhtml\Dashboard;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Esplin_StockDoctor::manage';

    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Esplin_StockDoctor::menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Stock Doctor Dashboard'));
        return $resultPage;
    }
}
