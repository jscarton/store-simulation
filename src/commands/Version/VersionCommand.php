<?php
namespace JScarton\Commands\Version;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class VersionCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('version')
            ->setDescription('Show version build');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = "Apples Store Simulator\n by Juan Scarton <jscarton@gmail.com>\n Version 1.0";
        $output->writeln($text);
    }
}