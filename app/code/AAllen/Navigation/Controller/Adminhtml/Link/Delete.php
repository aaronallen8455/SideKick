<?php


namespace AAllen\Navigation\Controller\Adminhtml\Link;

class Delete extends \AAllen\Navigation\Controller\Adminhtml\Link
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('link_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('AAllen\Navigation\Model\Link');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the Link.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['link_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a Link to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
