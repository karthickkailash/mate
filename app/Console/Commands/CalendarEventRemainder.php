<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenants\Calendar;
use App\Models\Tenant;
use App\Models\Domain;
use Carbon\Carbon;
use App\Jobs\CalendarEventReminderJob;

class CalendarEventRemainder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CalendarEventRemainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calendar events reminder via email';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $tenants = Tenant::get();

        foreach ($tenants as $row) {

            $tenant = Tenant::find($row->id);
            $domain = Domain::where('tenant_id', $tenant->id)->first();

            // Initialize tenant context
            tenancy()->initialize($tenant);

            $events = Calendar::with('user');
            $events = $events->get();

            foreach ($events as $row) {
                
                if($row->reminder == '10 mins') {
                    $reminder = 10;
                } elseif($row->reminder == '15 mins') {
                    $reminder = 15;
                } elseif($row->reminder == '30 mins') {
                    $reminder = 30;
                } elseif($row->reminder == '1 hrs') {
                    $reminder = 60;
                } elseif($row->reminder == '2 hrs') {
                    $reminder = 120;
                } else {
                    $reminder = 0;
                }

                $email = false;

                if($row->repeat == 'only once' && (Carbon::parse($row->start_time)->format('Ymdhi') == Carbon::now()->format('Ymdhi'))) {

                    $email = true;
                    
                } elseif($row->repeat == 'every day' && (Carbon::parse($row->start_time)->format('hi') == Carbon::now()->addMinutes($reminder)->format('hi'))) {
                    
                    $email = true;

                } elseif($row->repeat == 'every month' && (Carbon::parse($row->start_time)->format('dhi') == Carbon::now()->addMinutes($reminder)->format('dhi'))) {
                    
                    $email = true;

                } elseif($row->repeat == 'every year' && (Carbon::parse($row->start_time)->format('mdhi') == Carbon::now()->addMinutes($reminder)->format('mdhi'))) {
                    
                    $email = true;

                } else {

                    $email = false;

                }

                if($email) {

                    $mailBody = [
                        'email' => $row->user->email,
                        'body' => [
                            'data' => $row,
                            'company' => $domain->company_name
                        ],
                        'subject' => 'Event reminder mail',
                    ];

                    dispatch(new CalendarEventReminderJob($mailBody));
                }
            }        
        }

        return 1;
    }
}
