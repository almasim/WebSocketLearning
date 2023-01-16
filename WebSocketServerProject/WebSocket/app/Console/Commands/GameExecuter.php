<?php

namespace App\Console\Commands;

use App\Events\RemainingTimeChanged;
use App\Events\WinnerNumberGenerate;
use Illuminate\Console\Command;

class GameExecuter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Executing the game';

    private $time=15;
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while(true){                                                        //repeat forever
            broadcast(new RemainingTimeChanged($this->time.'s'));           //writing out remaining time for all users on the page
            $this->time--;                                                  //taking away time and let it be there for a sec
            sleep(1);

            if($this->time===0){                                            //if the number reaches zero write Waiting instead of the number then writing out for all user
                $this->time="Waiting to start";                             
                broadcast(new RemainingTimeChanged($this->time));       

                broadcast(new WinnerNumberGenerate(mt_rand(1,12)));         //make a random number and declare that as the winning number

                sleep(5);                                                   //sleep for 5 sec and restart the timer 
                $this->time=15;
            }
        }
    }
}
