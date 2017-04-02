<?php

namespace Hackathon\GeneratedCodeReaper\Model\Reaper;

use Magento\Framework\App\Filesystem\DirectoryList;

abstract class AbstractReaper implements ReaperInterface
{
    /**
     * @var DirectoryList
     */
    private $directoryList;

    public function __construct(DirectoryList $directoryList)
    {
        $this->directoryList = $directoryList;
    }

    /**
     * Taken from http://stackoverflow.com/a/7153391/3141504
     *
     * @param string $filename
     * @return string
     */
    protected function getFullClassname($filename)
    {
        $fp = fopen($filename, 'r');
        $class = $namespace = $buffer = '';
        $i = 0;
        while (!$class) {
            if (feof($fp)) break;

            $buffer .= fread($fp, 512);
            $tokens = @token_get_all($buffer);
            if (!is_array($tokens)) {
                echo $filename . PHP_EOL;
            }

            if (strpos($buffer, '{') === false) continue;

            for (;$i<count($tokens);$i++) {
                if ($tokens[$i][0] === T_NAMESPACE) {
                    for ($j=$i+1;$j<count($tokens); $j++) {
                        if ($tokens[$j][0] === T_STRING) {
                            $namespace .= '\\'.$tokens[$j][1];
                        } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                            break;
                        }
                    }
                }

                if ($tokens[$i][0] === T_CLASS) {
                    for ($j=$i+1;$j<count($tokens);$j++) {
                        if ($tokens[$j] === '{') {
                            if (isset($tokens[$i+2][1])) {
                                $class = $tokens[$i+2][1];
                            }
                        }
                    }
                }
            }
        }
        return $namespace . '\\' . $class;
    }

    /**
     * @param string $classname
     */
    protected function deleteGeneratedFileForClassname($classname)
    {
        $generatedCodeBaseDirectory = $this->directoryList->getPath(\Magento\Framework\App\Filesystem\DirectoryList::GENERATION);
        $filename = $generatedCodeBaseDirectory . implode(DIRECTORY_SEPARATOR, explode('\\', $classname)) . '.php';
        if (is_file($filename)) {
            unlink($filename);
        }
    }
}