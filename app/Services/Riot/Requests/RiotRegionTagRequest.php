<?php

namespace App\Services\Riot\Requests;

use App\Services\Riot\Enums\RegionTagEnum;
use Illuminate\Http\Client\Factory as HttpFactory;
use JustSteveKing\Transporter\Request;

abstract class RiotRegionTagRequest extends Request
{
    public function __construct(HttpFactory $http, RegionTagEnum $regionTag)
    {
        parent::__construct($http);

        parent::withQuery(['api_key' => config('services.riot.api_key')]);

        $this->baseUrl = sprintf(config('services.riot.base_uri'), $regionTag->value);
    }
}
