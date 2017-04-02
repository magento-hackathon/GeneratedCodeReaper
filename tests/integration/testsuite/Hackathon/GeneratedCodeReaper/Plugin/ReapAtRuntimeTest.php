<?php

namespace Hackathon\GeneratedCodeReaper\Plugin;

use Magento\TestFramework\ObjectManager;
use Magento\TestFramework\Interception\PluginList;
use Magento\Framework\Code\Generator;

class ReapAtRuntimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function setUp()
    {
        $this->objectManager = ObjectManager::getInstance();
        parent::setUp();
    }

    public function testPluginIsConfigured()
    {
        /** @var PluginList $pluginList */
        $pluginList = $this->objectManager->create(PluginList::class);

        $pluginInfo = $pluginList->get(Generator::class, []);
        $this->assertSame(ReapAtRuntime::class, $pluginInfo['hackathon_generatedcodereaper_reapatruntime']['instance']);
    }
}