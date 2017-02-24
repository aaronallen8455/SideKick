<?php
/**
 * Created by PhpStorm.
 * User: Aaron Allen
 * Date: 2/24/2017
 * Time: 3:51 AM
 */

namespace AAllen\BuyNow\Plugin;


use Magento\Checkout\Controller\Cart\Add;
use Magento\Checkout\Model\Cart;
use Magento\Framework\UrlInterface;

class BeforeAdd
{
    /** @var UrlInterface $urlBuilder */
    protected $urlBuilder;

    /** @var Cart $cart */
    protected $cart;

    public function __construct(UrlInterface $urlBuilder, Cart $cart)
    {
        $this->urlBuilder = $urlBuilder;
        $this->cart = $cart;
    }

    /**
     * Set redirect url and empty cart if 'buynow' was clicked
     *
     * @param Add $subject
     */
    public function beforeExecute(Add $subject)
    {
        if ($subject->getRequest()->getParam('buy_now')) {
            $subject->getRequest()->setParams(['return_url' => $this->urlBuilder->getUrl('checkout/')]);
            $this->cart->truncate();
        }
    }
}