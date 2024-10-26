<?php

namespace App\Services\Riot\Enums;

enum RegionTagEnum: string
{
    case BR = 'br1';
    case EUN = 'eun1';
    case EUW = 'euw1';
    case JP = 'jp1';
    case KR = 'kr';
    case LA1 = 'la1';
    case LA2 = 'la2';
    case ME = 'me1';
    case NA = 'na1';
    case OC = 'oc1';
    case PH = 'ph2';
    case RU = 'ru';
    case SG = 'sg2';
    case TH = 'th2';
    case TR = 'tr1';
    case TW = 'tw2';
    case VN = 'vn2';

    public function getRegionName(): string
    {
        return match ($this) {
            RegionTagEnum::BR => 'Brazil',
            RegionTagEnum::EUN => 'Europe East',
            RegionTagEnum::EUW => 'Europe West',
            RegionTagEnum::JP => 'Japan',
            RegionTagEnum::KR => 'Korea',
            RegionTagEnum::LA1 => 'LAN',
            RegionTagEnum::LA2 => 'LAS',
            RegionTagEnum::ME => 'Middle East',
            RegionTagEnum::NA => 'North America',
            RegionTagEnum::OC => 'Oceania',
            RegionTagEnum::PH => 'Philippines',
            RegionTagEnum::RU => 'Russia',
            RegionTagEnum::SG => 'Singapore',
            RegionTagEnum::TH => 'Thailand',
            RegionTagEnum::TR => 'Turkiye',
            RegionTagEnum::TW => 'Taiwan',
            RegionTagEnum::VN => 'Vietnam',
        };
    }

    public function getSummonerTag(): string
    {
        return match ($this) {
            RegionTagEnum::BR => 'BR1',
            RegionTagEnum::EUN => 'EUNE',
            RegionTagEnum::EUW => 'EUW',
            RegionTagEnum::JP => 'JP1',
            RegionTagEnum::KR => 'KR1',
            RegionTagEnum::LA1 => 'LAN',
            RegionTagEnum::LA2 => 'LAS',
            RegionTagEnum::ME => 'ME1',
            RegionTagEnum::NA => 'NA1',
            RegionTagEnum::OC => 'OCE',
            RegionTagEnum::PH => 'PH2',
            RegionTagEnum::RU => 'RU1',
            RegionTagEnum::SG => 'SG2',
            RegionTagEnum::TH => 'TH2',
            RegionTagEnum::TR => 'TR1',
            RegionTagEnum::TW => 'TW2',
            RegionTagEnum::VN => 'VN2',
        };
    }
}
