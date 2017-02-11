<?php
/**
 * Created by PhpStorm.
 * User: Aaron Allen
 * Date: 2/11/2017
 * Time: 2:23 AM
 */

namespace AAllen\Navigation\Block;


use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Model\Page;
use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

class CmsPageLinks extends Template implements IdentityInterface
{
    /** @var  \Magento\Cms\Model\ResourceModel\Page\Collection */
    protected $pageCollection;

    protected $_pages;

    public function __construct(
        Template\Context $context,

        CollectionFactory $collectionFactory,
        array $data = [])
    {
        $this->pageCollection = $collectionFactory->create();

        parent::__construct($context, $data);
    }

    /**
     * Returns an array of html strings for each cms page navigation link
     *
     * @return string
     */
    public function getLinks()
    {
        if (!isset($this->_pages)) {
            $result = '';
            //$pages = $this->pageRepository->getList(
            //    $this->searchCriteriaBuilder->addFilters([
            //        $this->filterBuilder->setField('show_in_navigation')->setConditionType('eq')->setValue(1)->create(),
            //        $this->filterBuilder->setField('is_active')->setConditionType('eq')->setValue(1)->create()
            //    ])->create()
            //);

            $pages = $this->pageCollection
                ->addFieldToSelect(['is_active', 'show_in_navigation', 'title', 'identifier', 'sort_order'])
                ->addFieldToFilter('is_active', 1)
                ->addFieldToFilter('show_in_navigation', 1)
                ->setOrder('sort_order', AbstractDb::SORT_ORDER_ASC)
                ->load();

            /** @var Page $page */
            foreach ($pages as $page) {
                $link = $this->getLayout()->createBlock('AAllen\Navigation\Block\Html\CmsLink')
                    ->setLabel($page->getTitle())
                    ->setPath($page->getIdentifier());

                $result .= $link->toHtml();
            }
            $this->_pages = $result;
        }
        return $this->_pages;
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