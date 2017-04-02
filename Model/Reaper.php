<?php


namespace Hackathon\GeneratedCodeReaper\Model;

use Hackathon\GeneratedCodeReaper\Model\Reaper\ReaperInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class Reaper
{
    /**
     * @var Flag
     */
    private $flag;
    /**
     * @var FileFinder
     */
    private $fileFinder;
    private $reapers;

    public function __construct(Flag $flag, FileFinder $fileFinder, $reapers)
    {
        $this->flag = $flag->loadSelf();
        $this->fileFinder = $fileFinder;
        $this->reapers = $reapers;
    }

    public function execute()
    {
        $timestamp = $this->flag->getFlagData();
        $this->flag->setFlagData(time())->save();
        $files = $this->fileFinder->getChangedFiles($timestamp);

        foreach($this->reapers as $reaper) {
            /** @var ReaperInterface $reaper */
            $reaper->reap($files);
        }
    }
}