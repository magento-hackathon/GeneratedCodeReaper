<?php

namespace Hackathon\GeneratedCodeReaper\Plugin;

use Magento\Framework\Code\Generator;
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

    public function afterSetObjectManager(
        Generator $subject,
        $result
    ) {
        if (!$this->hasReaped && $this->scopeConfig->getValue(self::XML_PATH_REAP_AT_RUNTIME)) {
            $this->runReaper();
        }

        return [$result];
    }

    private function runReaper()
    {
        $this->reaper->execute();
        $this->hasReaped = true;
    }
}