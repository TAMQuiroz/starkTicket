<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
        $schedule->call(function(){
            $reservas = DB::table('tickets')->where('reserve',0)->get();
            foreach ($reservas as $reserva) {
                $reserve_date = strtotime($reserva->created_at);
                if($reserva_date + (3600*24) >= time()){
                    if($reserve->seat_id!=null)
                        DB::table('slot_presentation')->where('slot_id', $reserve->seat_id)
                        ->update('status', config('constants.seat_free'));
                    else
                        DB::table('zone_presentation')->where('zone_id', $reserve->zone_id)
                        ->increment('slots_availables');
                    $reserva->delete();
                }
            }
        })->hourly();
        $schedule->call(function(){
            $noDestacados = DB::table('highlights')->where('active','1')->get();
            if($noDestacados)
                foreach ($noDestacados as $noDestacado) {
                    $tiempo = strtotime($noDestacado->start_date)+$noDestacado->active_days;
                    if($tiempo > time()){
                        $noDestacado->active = false;
                        $noDestacado->save();
                    }
                }
            $destacados = DB::table('highlights')->where('start_date',Carbon::now())->get();
            if($destacados)
                foreach($destacados as $destacado){
                    $destacado->active = true;
                    $destacado->save();
                }
        })->daily();
    }
}
