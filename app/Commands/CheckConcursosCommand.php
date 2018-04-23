<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Storage;


class CheckConcursosCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'check:concursos';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Check of current available jobs';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {

        $output = "";
        $this->task("Checking site", function () use (&$output) {
            $output = file_get_contents("https://www.santafe.gov.ar/index.php/web/guia/convocatorias?ajax_call=1&page=1&estado=0");
            return $output;
        });

        $filename = "concursos.html";

        $input = "";
        if (Storage::exists($filename)) {
            $input = Storage::get($filename);    
        }
        
        $check_input = md5($input);
        $check_output = md5($output);        
        $this->task("Are there any changes ?", function() use ($check_input, $check_output) {
            return $check_input !== $check_output;
        });

        if ($check_input !== $check_output) {
            $this->sendNotification();
        }

        Storage::put($filename, $output);
        
    }

    protected function sendNotification(): void
    {
        $icon = resource_path('assets/timer.png');
        $this->notify("Santa Fe informa", "Hubo cambios en los concursos", $icon);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        $schedule->command(static::class)->hourly();
    }
}
