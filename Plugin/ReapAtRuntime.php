<?php

namespace Hackathon\GeneratedCodeReaper\Plugin;

use Magento\Framework\ObjectManager\ConfigLoaderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Hackathon\GeneratedCodeReaper\Model\Reaper;

class ReapAtRuntime
{

    const XML_PATH_REAP_AT_RUNTIME = 'dev/static/reaper_at_runtime';

    private $hasReaped = false;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var Reaper
     */
    private $reaper;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Reaper $reaper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->reaper = $reaper;
    }

    public function beforeLoad(
        ConfigLoaderInterface $subject,
        $requestedType,
        array $arguments = []
    ) {
        if (!$this->hasReaped && $this->scopeConfig->getValue(self::XML_PATH_REAP_AT_RUNTIME)) {
            $this->runReaper();
        }

        return [$requestedType, $arguments];
    }

    private function runReaper()
    {
        $this->reaper->execute();
        $this->hasReaped = true;
    }
}