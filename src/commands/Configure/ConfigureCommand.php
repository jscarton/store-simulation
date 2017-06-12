<?php
namespace JScarton\Commands\Configure;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigureCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('configure')
            ->setDescription('Generates simulation settings');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Apples Store Simulator\n by Juan Scarton <jscarton@gmail.com>\nVersion @package_version@';
        $output->writeln($text);
    }
}