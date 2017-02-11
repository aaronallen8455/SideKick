<?php
/**
 * Created by PhpStorm.
 * User: Aaron Allen
 * Date: 2/11/2017
 * Time: 2:11 AM
 */

namespace AAllen\Navigation\Model\Page\Source;


use Magento\Framework\Data\OptionSourceInterface;

class ShowInNavigation implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            [
                'label' => 'Yes',
                'value' => 1
            ],
            [
                'label' => 'No',
                'value' => 0
            ]
        ];
    }
}