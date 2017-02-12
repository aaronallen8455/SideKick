<?php


namespace AAllen\Navigation\Model\ResourceModel;

class Link extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('aallen_link', 'link_id');
    }
}
