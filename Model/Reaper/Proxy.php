<?php

namespace Hackathon\GeneratedCodeReaper\Model\Reaper;

class Proxy extends AbstractReaper
{
    public function reap($filenames)
    {
        foreach($filenames as $filename) {
            if (substr($filename, -4) != '.php') {
                continue;
            }

            $classname = $this->getFullClassname($filename) . '\\Proxy';

            $this->deleteGeneratedFileForClassname($classname);
        }
    }
}