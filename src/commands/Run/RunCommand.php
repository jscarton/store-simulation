<?php
namespace JScarton\Commands\Run;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Runs the simulator process');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = 'Apples Store Simulator\n by Juan Scarton <jscarton@gmail.com>\nVersion @package_version@';
        $output->writeln($text);
    }
}