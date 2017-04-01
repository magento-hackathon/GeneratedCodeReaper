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
     * @return string[]
     */
    public function getChangedFiles()
    {
        $foundFiles = [];
        foreach ($this->getBaseDirectories() as $baseDirectory) {
            $directoryIterator = new \RecursiveDirectoryIterator($baseDirectory);
            $iteratorIterator = new \RecursiveIteratorIterator($directoryIterator);

            foreach ($iteratorIterator as $file) {
                if ($this->isFileValid($file)) {
                    $foundFiles[] = $file->getPath() . DIRECTORY_SEPARATOR . $file->getFileName();
                }
            }
        }
        return $foundFiles;
    }

    /**
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
     * @return bool
     */
    private function isFileValid($file)
    {
        if($file->getFilename() == 'registration.php') {
            return false;
        }
        return ($file->getFilename() == 'di.xml' || substr($file->getFilename(), -4) == '.php') && $file->getMTime() >= 1444177204;
    }
}