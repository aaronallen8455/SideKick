<?php
/**
 * Created by PhpStorm.
 * User: Aaron Allen
 * Date: 2/11/2017
 * Time: 1:25 AM
 */

namespace AAllen\Navigation\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // add the show_in_navigation field
        $setup->getConnection()->addColumn(
            $setup->getTable('cms_page'),
            'show_in_navigation',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'nullable' => true,
                'default' => 0,
                'comment' => 'Display link to this page in navigation menu'
            ]
        );

        $setup->endSetup();
    }
}