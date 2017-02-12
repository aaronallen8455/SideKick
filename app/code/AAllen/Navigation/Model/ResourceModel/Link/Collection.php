<?php


namespace AAllen\Navigation\Model\ResourceModel\Link;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'AAllen\Navigation\Model\Link',
            'AAllen\Navigation\Model\ResourceModel\Link'
        );
    }
}
