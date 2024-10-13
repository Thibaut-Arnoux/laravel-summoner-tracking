<?php

namespace App\Services\Riot\Requests;

use Illuminate\Http\Client\Factory as HttpFactory;
use JustSteveKing\Transporter\Request;

class RiotRegionNameRequest extends Request
{
    public function __construct(HttpFactory $http)
    {
        parent::__construct($http);

        parent::withQuery(['api_key' => config('services.riot.api_key')]);

        $this->baseUrl = sprintf(config('services.riot.base_uri'), config('services.riot.region_name'));
    }
}
