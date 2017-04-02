<?php

namespace Hackathon\GeneratedCodeReaper\Plugin;

use Magento\Framework\ObjectManager\ConfigLoaderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ReapAtRuntime
{

    const XML_PATH_REAP_AT_RUNTIME = 'dev/static/reaper_at_runtime';

    private $hasReaped = false;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function beforeLoad(
        ConfigLoaderInterface $subject,
        $requestedType,
        array $arguments = []
    ) {
        if ($this->scopeConfig->getValue(self::XML_PATH_REAP_AT_RUNTIME) && !$this->hasReaped) {
            $this->runReaper();
        }

        return [$requestedType, $arguments];
    }

    private function runReaper()
    {
        $this->hasReaped = true;
    }
}