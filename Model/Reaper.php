<?php


namespace Hackathon\GeneratedCodeReaper\Model;

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

    public function __construct(Flag $flag, FileFinder $fileFinder)
    {
        $this->flag = $flag->loadSelf();
        $this->fileFinder = $fileFinder;
    }

    public function execute()
    {
        $timestamp = $this->flag->getFlagData();
        $files = $this->fileFinder->getChangedFiles($timestamp);
        $this->flag->setFlagData(time())->save();
    }
}