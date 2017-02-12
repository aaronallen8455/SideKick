<?php
/**
 * Created by PhpStorm.
 * User: Aaron Allen
 * Date: 2/11/2017
 * Time: 2:23 AM
 */

namespace AAllen\Navigation\Block;


use AAllen\Navigation\Model\ResourceModel\Link\CollectionFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

class CmsPageLinks extends Template implements IdentityInterface
{
    /** @var  \Magento\Cms\Model\ResourceModel\Page\Collection */
    protected $linkCollection;

    protected $_links;

    public function __construct(
        Template\Context $context,

        CollectionFactory $collectionFactory,
        array $data = [])
    {
        $this->linkCollection = $collectionFactory->create();

        parent::__construct($context, $data);
    }

    /**
     * Returns an array of html strings for each cms page navigation link
     *
     * @return string
     */
    public function getLinks()
    {
        if (!isset($this->_links)) {
            $result = '';
            //$pages = $this->pageRepository->getList(
            //    $this->searchCriteriaBuilder->addFilters([
            //        $this->filterBuilder->setField('show_in_navigation')->setConditionType('eq')->setValue(1)->create(),
            //        $this->filterBuilder->setField('is_active')->setConditionType('eq')->setValue(1)->create()
            //    ])->create()
            //);

            $links = $this->linkCollection
                ->addFieldToSelect(['is_active', 'label', 'path', 'sort_order'])
                ->addFieldToFilter('is_active', 1)
                ->setOrder('sort_order', AbstractDb::SORT_ORDER_ASC)
                ->load();

            foreach ($links as $link) {
                $link = $this->getLayout()->createBlock('AAllen\Navigation\Block\Html\CmsLink')
                    ->setLabel($link->getLabel())
                    ->setPath($link->getPath());

                $result .= $link->toHtml();
            }
            $this->_links = $result;
        }
        return $this->_links;
    }

    protected function _toHtml()
    {
        return $this->getLinks();
    }

    /**
     * Get cache IDs
     *
     * @return array
     */
    public function getIdentities()
    {
        return ['aallen_navigation_block'];
    }
}