<?php
namespace Hackathon\GeneratedCodeReaper\Command;

use AvS\DisableModules\Console\Report\RemovableModules\Builder;
use AvS\DisableModules\Console\Report\RemovableModules\Parser;
use AvS\DisableModules\Console\Report\RemovableModules\Writer;
use Magento\Framework\App\Utility\Files;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Component\DirSearch;
use Magento\Framework\View\Design\Theme\ThemePackageList;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Setup\Module\Dependency\Report\Dependency;

/**
 * Command for showing nmodules which can be removed / disabled
 */
class ReaperCommand extends \Symfony\Component\Console\Command\Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Clean up generated code depending on last file changes')
            ->setName('setup:di:reap');
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln('<info>Command started successfully.</info>');
        } catch (\Exception $e) {
            $output->writeln(
                '<error>' . $e->getMessage() . '</error>'
            );
            // we must have an exit code higher than zero to indicate something was wrong
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}
