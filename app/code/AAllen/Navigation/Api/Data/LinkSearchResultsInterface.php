<?php


namespace AAllen\Navigation\Api\Data;

interface LinkSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Link list.
     * @return \AAllen\Navigation\Api\Data\LinkInterface[]
     */
    
    public function getItems();

    /**
     * Set path list.
     * @param \AAllen\Navigation\Api\Data\LinkInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
