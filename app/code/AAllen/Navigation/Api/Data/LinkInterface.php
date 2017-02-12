<?php


namespace AAllen\Navigation\Api\Data;

interface LinkInterface
{

    const LINK_ID = 'link_id';
    const LABEL = 'label';
    const PATH = 'path';
    const SORT_ORDER = 'sort_order';
    const IS_ACTIVE = 'is_active';


    /**
     * Get link_id
     * @return string|null
     */
    public function getLinkId();

    /**
     * Set link_id
     * @param string $link_id
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setLinkId($linkId);

    /**
     * Get sort order
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function getSortOrder();

    /**
     * Set sort order
     * @param $sortOrder
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Get path
     * @return string|null
     */
    public function getPath();

    /**
     * Set path
     * @param string $path
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setPath($path);

    /**
     * Get label
     * @return string|null
     */
    public function getLabel();

    /**
     * Set label
     * @param string $label
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setLabel($label);

    /**
     * Get is_active
     * @return string|null
     */
    public function isActive();

    /**
     * Set is_active
     * @param string $is_active
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setIsActive($is_active);
}
