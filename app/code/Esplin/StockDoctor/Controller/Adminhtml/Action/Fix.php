<?php
namespace Esplin\StockDoctor\Controller\Adminhtml\Action;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Esplin\StockDoctor\Model\CliRunner;

class Fix extends Action
{
    const ADMIN_RESOURCE = 'Esplin_StockDoctor::manage';

    protected $cliRunner;

    public function __construct(Action\Context $context, CliRunner $cliRunner)
    {
        parent::__construct($context);
        $this->cliRunner = $cliRunner;
    }

    public function execute()
    {
        $output = $this->cliRunner->run('inventory:reservation:fix-inconsistencies');
        $this->messageManager->addSuccessMessage(__('Fix complete. Output: %1', $output));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('stockdoctor/dashboard/index');
        return $resultRedirect;
    }
}
