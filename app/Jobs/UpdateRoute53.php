<?php

namespace App\Jobs;

use App\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateRoute53 implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Site
     */
    private $site;
    /**
     * @var string
     */
    private $action;

    /**
     * Create a new job instance.
     *
     * @param Site $site
     * @param string $action
     */
    public function __construct(Site $site, $action = 'UPSERT')
    {
        //
        $this->site = $site;
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = \AWS::createClient('route53');

        $response = $client->changeResourceRecordSets([
            'HostedZoneId' => env('HOSTED_ZONE_ID'),
            'ChangeBatch' => [
                'Changes'   => [
                    [
                        'Action'    => $this->action,
                        'ResourceRecordSet' => [

                            'Name' => $this->site->subdomain . '.' . env('HOSTED_ZONE_DOMAIN') . '.', // REQUIRED
                            'Type' => $this->site->type, // REQUIRED
                            'TTL'   => $this->site->ttl,
                            'ResourceRecords' => [
                                [
                                    'Value' => $this->site->target,
                                ],
                            ],
                        ],
                    ]
                ],
            ],
        ]);

        if($this->action == 'DELETE') $this->site->delete();

        return;
    }
}
