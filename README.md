# JScarton's Apple Store Simulation Test

Based in the received requirements I've developed a simple simulation program using PHP as programming language.


## Features

* OOP structure
* Shell based application using symfony's components
* Dependency management with [Composer](http://getcomposer.org)
* Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
* Could be compiled into a phar file with Box (build script included)

## Installation

1. Clone the git repo - `git clone https://github.com/jscarton/store.git`
2. Run `composer install`
3. Check .env file to adjust configuration settings for the simulator

## Running

You could run the project by typing: "php simulator.php run"


You also can compile the entire project into a phar file by typing:  "box build" and then run the phar file.


## getting help
if you type php simulator.php without the "run" command you will see a full list of available options

## It is a final solution?
Absolutely NO!!!!

A good simulator involves develop a good random events generator using a probability distribution specially designed for the simulation case. This is only a little showcase of PHP language programming and Software Development Skills.

Any shelve on this solution is threated as a FIFO Queue when many customers could be enqueued into the shelve and the first in is also the first going out.

The events are very simple, could be improved.

Apple Class implements an interface called Fruits that could be used in the future to add more than one type of fruit (orange in example)

For time and keeping the simplicity Security Guard and Cashiers were not taken in count in this solution.

## Any question?

Do not hesitate to contact me at jscarton@gmail.com

