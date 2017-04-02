<?php

namespace Hackathon\GeneratedCodeReaper\Model\Reaper;

class Interceptor extends AbstractReaper
{
    public function reap($filenames)
    {
        foreach($filenames as $filename) {
            if (substr($filename, -4) != '.php') {
                continue;
            }

            $classname = $this->getFullClassname($filename) . '\\Interceptor';

            $this->deleteGeneratedFileForClassname($classname);
        }
    }
}