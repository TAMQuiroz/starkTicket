<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Carbon\Carbon;
use Log;
use App\Models\Ticket;
use App\Models\Slot;
use App\Models\Event;
use App\Models\Highlight;
use App\Models\Presentation;
use App\Models\Zone;
use App\Models\Local;

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
            $reservas = Ticket::whereNotNull('reserve')->get();
            foreach ($reservas as $reserva) {
                $reserve_date = strtotime($reserva->created_at);
                if($reserve_date + (3600*24) <= time()){
                    if($reserva->event->place->rows!=null)
                        DB::table('slot_presentation')->where('sale_id', $reserva->id)
                        ->update(['status' => config('constants.seat_free')]);
                    else{
                        DB::table('zone_presentation')->where('zone_id', $reserva->zone_id)
                        ->increment('slots_availables',$reserva->quantity);
                    }
                    $reserva->delete();
                }
            }
        })->everyHour();
        $schedule->call(function(){
            $destacados = Highlight::where('start_date','<=',Carbon::now())->get();
            if($destacados && !empty($destacados))
                foreach($destacados as $destacado){
                    $destacado->active = true;
                    $destacado->save();
                }
            $noDestacados = Highlight::where('active','1')->get();
            if($noDestacados && !empty($noDestacados))
                foreach ($noDestacados as $noDestacado) {
                    $tiempo = strtotime($noDestacado->start_date)+$noDestacado->active_days;
                    if($tiempo <= time()){
                        $noDestacado->active = false;
                        $noDestacado->save();
                    }
                }
        })->daily();
    }
}
