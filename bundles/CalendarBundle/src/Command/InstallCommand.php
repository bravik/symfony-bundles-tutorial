<?php

namespace bravik\CalendarBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class InstallCommand extends Command
{
    protected static $defaultName = 'bravik:calendar:install';


    /** @var Filesystem */
    private $filesystem;

    private $projectDir;

    public function __construct(Filesystem $filesystem, string $projectDir)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->projectDir = $projectDir;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Installing bravik/CalendarBundle...');

        $this->initConfig($output);

        return 0;
    }

    private function initConfig(OutputInterface $output): void
    {
        // Create default config if not exists
        $bundleConfigFilename = $this->projectDir
            . DIRECTORY_SEPARATOR . 'config'
            . DIRECTORY_SEPARATOR . 'packages'
            . DIRECTORY_SEPARATOR . 'calendar.yaml'
        ;
        if ($this->filesystem->exists($bundleConfigFilename)) {
            $output->writeln('Config file already exists');

            return;
        }

        $config = <<<YAML
calendar:
  enable_soft_delete: true
YAML;
        $this->filesystem->appendToFile($bundleConfigFilename, $config);

        $output->writeln('Config created: "config/packages/calendar.yaml"');

    }
}
