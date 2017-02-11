<?php
/**
 * Created by PhpStorm.
 * User: Aaron Allen
 * Date: 2/11/2017
 * Time: 3:53 AM
 */

namespace AAllen\Navigation\Block\Html;


use Magento\Framework\View\Element\Html\Link\Current;

class CmsLink extends Current
{
    public function isCurrent()
    {
        $url = $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true]);

        return rtrim($url, '/') == rtrim($this->getHref(), '/');
    }
}