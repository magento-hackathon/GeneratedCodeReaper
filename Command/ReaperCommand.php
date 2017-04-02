<?php
namespace Hackathon\GeneratedCodeReaper\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for selectively deleting generated code based on modified timestamp of originating file
 */
class ReaperCommand extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Hackathon\GeneratedCodeReaper\Model\Reaper
     */
    private $reaper;

    public function __construct(\Hackathon\GeneratedCodeReaper\Model\Reaper $reaper)
    {
        parent::__construct();
        $this->reaper = $reaper;
    }

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

            $this->reaper->execute();
        } catch (\Exception $e) {
            $output->writeln(
                '<error>' . $e->getMessage() . '</error>'
            );
            // we must have an exit code higher than zero to indicate something was wrong
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}
