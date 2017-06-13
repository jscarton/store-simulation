<?php
namespace JScarton\commands\run;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use JScarton\classes\simulation\Simulator;

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
        \Env::init();
        $dotenv = new \Dotenv\Dotenv(\getcwd());
        if (file_exists(\getcwd() . '/.env')) {
            $dotenv->load();
            $dotenv->required([
                'MAX_PERSONS', 
                'NUMBER_OF_SHELVES', 
                'MAX_CAPACITY_OF_SHELVES',
                'MAX_CASHIERS',
                'MAX_CASHIERS',
                'MIN_CASHIERS',
                'TIME_START',
                'TIME_END',
                'TICK_VALUE',
                'MAX_EVENTS_PER_TICK',
                'REPORT_TICK']);
        }
        //initializes the simulator
        $simulator=new Simulator(
                env('MAX_PERSONS'), 
                env('NUMBER_OF_SHELVES'), 
                env('MAX_CAPACITY_OF_SHELVES'),
                env('MAX_CASHIERS'),
                env('MIN_CASHIERS'),
                env('TIME_START'),
                env('TIME_END'),
                env('TICK_VALUE'),
                env('MAX_EVENTS_PER_TICK'),
                env('REPORT_TICK')
                );
        //runs the simulator
        $simulator->run();
    }
}