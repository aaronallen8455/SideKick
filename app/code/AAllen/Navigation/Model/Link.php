<?php


namespace AAllen\Navigation\Model;

use AAllen\Navigation\Api\Data\LinkInterface;
use Magento\Framework\Validator\Exception;

class Link extends \Magento\Framework\Model\AbstractModel implements LinkInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AAllen\Navigation\Model\ResourceModel\Link');
    }

    /**
     * Get link_id
     * @return string
     */
    public function getLinkId()
    {
        return $this->getData(self::LINK_ID);
    }

    /**
     * Set link_id
     * @param string $linkId
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setLinkId($linkId)
    {
        return $this->setData(self::LINK_ID, $linkId);
    }

    /**
     * Get path
     * @return string
     */
    public function getPath()
    {
        return $this->getData(self::PATH);
    }

    /**
     * Set path
     * @param string $path
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setPath($path)
    {
        return $this->setData(self::PATH, $path);
    }

    /**
     * Get label
     * @return string
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * Set label
     * @param string $label
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setLabel($label)
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * Get sort order
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * Set sort order
     * @param $sortOrder
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * Get is_active
     * @return string
     */
    public function isActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set is_active
     * @param string $is_active
     * @return \AAllen\Navigation\Api\Data\LinkInterface
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

    public function beforeSave()
    {
        // validate data
        if (empty($this->getPath()) || !preg_match('/^[\w\d\-_\/?=]+$/', $this->getPath())) {
            //throw new Exception('Invalid path.');
        }
        $this->setPath(strip_tags($this->getPath()));

        if (empty($this->getLabel())) {
            throw new Exception('Invalid label.');
        }
        $this->setLabel(strip_tags($this->getLabel()));

        return parent::beforeSave();
    }
}
