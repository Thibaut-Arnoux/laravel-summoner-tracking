<?php

use App\Livewire\Welcome;
use App\Services\Riot\Enums\RegionTagEnum;
use App\Services\Riot\RiotService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Welcome::class);

// DEBUG

// Account
Route::get('/riot/account/{puuid}', function (string $puuid, RiotService $riotService) {
    return $riotService->accountByPuuid($puuid);
});

Route::get('/riot/account/{gameName}/{tagLine}', function (RiotService $riotService, string $gameName, string $tagLine) {
    return $riotService->accountByNameAndTag($gameName, $tagLine);
});

// Summoner
Route::get('/riot/summoner/{regionTag}/puuid/{puuid}', function (RiotService $riotService, RegionTagEnum $regionTag, string $puuid) {
    return $riotService->summonerByPuuid($regionTag, $puuid);
});

Route::get('/riot/summoner/{regionTag}/accountId/{accountId}', function (RiotService $riotService, RegionTagEnum $regionTag, string $accountId) {
    return $riotService->summonerByAccountId($regionTag, $accountId);
});

Route::get('/riot/summoner/{regionTag}/summonerId/{summonerId}', function (RiotService $riotService, RegionTagEnum $regionTag, string $summonerId) {
    return $riotService->summonerById($regionTag, $summonerId);
});
