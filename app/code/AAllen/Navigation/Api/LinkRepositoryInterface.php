<?php


namespace AAllen\Navigation\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LinkRepositoryInterface
{


    /**
     * Save Link
     * @param \AAllen\Navigation\Api\Data\LinkInterface $link
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \AAllen\Navigation\Api\Data\LinkInterface $link
    );

    /**
     * Retrieve Link
     * @param string $linkId
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($linkId);

    /**
     * Retrieve Link matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AAllen\Navigation\Api\Data\LinkSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Link
     * @param \AAllen\Navigation\Api\Data\LinkInterface $link
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \AAllen\Navigation\Api\Data\LinkInterface $link
    );

    /**
     * Delete Link by ID
     * @param string $linkId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($linkId);
}
