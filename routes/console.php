<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('domain', function () {

    // Zone ID: Z1225J66UQ9JM4

    $client = \AWS::createClient('route53');

    $response = $client->changeResourceRecordSets([
        'HostedZoneId' => 'Z1225J66UQ9JM4',
        'ChangeBatch' => [
            'Changes'   => [
                [
                    'Action'    => 'UPSERT',
                    'ResourceRecordSet' => [ // REQUIRED

                            'Name' => 'ezyquip.iseekplant.ninja.', // REQUIRED
                            'Type' => 'CNAME', // REQUIRED
                            'TTL'   => 60,
                            'ResourceRecords' => [
                                [
                                    'Value' => 'planthire.com.au',
                                ],
                            ],
                    ],
                ]
            ],
        ],
    ]);



    $response['ChangeInfo']['Id'];
    dd($response);

    /*
     * Aws\Result {#642
  -data: array:2 [
    "ChangeInfo" => array:3 [
      "Id" => "/change/C3H2KINFR6MBL9"
      "Status" => "PENDING"
      "SubmittedAt" => Aws\Api\DateTimeResult {#651
        +"date": "2017-01-11 22:54:37.481000"
        +"timezone_type": 2
        +"timezone": "Z"
      }
    ]
    "@metadata" => array:4 [
      "statusCode" => 200
      "effectiveUri" => "https://route53.amazonaws.com/2013-04-01/hostedzone/Z1225J66UQ9JM4/rrset/"
      "headers" => array:4 [
        "x-amzn-requestid" => "ed788343-d850-11e6-b56e-4f3c089c8b8f"
        "content-type" => "text/xml"
        "content-length" => "276"
        "date" => "Wed, 11 Jan 2017 22:54:36 GMT"
      ]
      "transferStats" => array:1 [
        "http" => array:1 [
          0 => []
        ]
      ]
    ]
  ]
}

     */

})->describe('Do the Route 53 stuff');
