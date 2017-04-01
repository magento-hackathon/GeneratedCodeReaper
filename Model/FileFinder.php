<?php


namespace Hackathon\GeneratedCodeReaper\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class FileFinder
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var DirectoryList
     */
    private $directoryList;

    public function __construct(ScopeConfigInterface $scopeConfig, DirectoryList $directoryList)
    {
        $this->scopeConfig = $scopeConfig;
        $this->directoryList = $directoryList;
    }

    /**
     * Get files which have been changed since the given timestamp
     *
     * @param int|null $timestamp
     * @return string[]
     */
    public function getChangedFiles($timestamp = null)
    {
        $foundFiles = [];
        foreach ($this->getBaseDirectories() as $baseDirectory) {
            $directoryIterator = new \RecursiveDirectoryIterator($baseDirectory);
            $iteratorIterator = new \RecursiveIteratorIterator($directoryIterator);

            foreach ($iteratorIterator as $file) {
                if ($this->isFileValidAndModified($file, $timestamp)) {
                    $foundFiles[] = $file->getPath() . DIRECTORY_SEPARATOR . $file->getFileName();
                }
            }
        }
        return $foundFiles;
    }

    /**
     * Get base directories form configuration, i.e. 'app/code/'
     *
     * @return string[]
     */
    private function getBaseDirectories()
    {
        $validBaseDirectories = [];
        $baseDirectories = preg_split("/\r\n|\n|\r/", $this->scopeConfig->getValue('dev/static/reaper_paths'));
        foreach ($baseDirectories as $baseDirectory) {
            $baseDirectory = $this->directoryList->getRoot() . DIRECTORY_SEPARATOR . $baseDirectory;
            if (\is_dir($baseDirectory)) {
                $validBaseDirectories[] = $baseDirectory;
            }
        }
        return $validBaseDirectories;
    }

    /**
     * @param \SplFileInfo $file
     * @param int|null $timestamp
     * @return bool
     */
    private function isFileValidAndModified($file, $timestamp = null)
    {
        if($file->getFilename() == 'registration.php') {
            return false;
        }
        if (($file->getFilename() != 'di.xml') && (substr($file->getFilename(), -4) != '.php')) {
            return false;
        }

        if ($timestamp) {
            return $file->getMTime() >= $timestamp;
        }

        return true;
    }
}