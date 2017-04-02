<?php

namespace Hackathon\GeneratedCodeReaper\Plugin;

use Magento\Framework\ObjectManager\ConfigLoaderInterface;

class ReapAtRuntime
{

    private $hasReaped = false;

    public function beforeLoad(
        ConfigLoaderInterface $subject,
        $requestedType,
        array $arguments = []
    ) {
        if (!$this->hasReaped) {
            $this->runReaper();
        }

        return [$requestedType, $arguments];
    }

    private function runReaper()
    {
        $this->hasReaped = true;
    }
}