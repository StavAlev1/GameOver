<?php

namespace App\Services;


class QuoteService
{
    public function priceCalc($request): int
    {
        $sub = (base_convert($request['pickup_postcode'], 36, 10) - 
        base_convert($request['delivery_postcode'], 36, 10));

        $result = intval(abs($sub / 100000000));

        return $result;
    }

    private function vehicleMarkup($sub, $vehicle)
    {
        switch($vehicle) {
            case('bicycle'):
                return $sub * 10 / 100;
            case('motorbike'):
                return $sub * 15 / 100;
            case('parcel_car'):
                return $sub * 20 / 100;
            case('small_van'):
                return $sub * 30 / 100;
            case('large_van'):
                return $sub * 40 / 100;
            default:
                return null;
        };
    }

    public function priceList($request, $sub)
    {
        $priceList = [];
        $carriers = json_decode(file_get_contents(storage_path() . "\app\public\carriers.json"), true);

        $filterCarriers = collect($carriers['carriers'])->filter(function ($carrier) use ($request) {
            $availableVehicles = explode(',', $carrier['available_vehicles']);
            return in_array($request['vehicle'], $availableVehicles);
        });

        if(! empty($filterCarriers)) {
            $mapped =  collect($filterCarriers)->map(function ($carrier) use ($sub) { 
                return [
                    'service' => $carrier['service'],
                    'price' => intval(abs($sub + ($sub * $carrier['price_percent'] / 100))),
                    'delivery_time' => $carrier['delivery_time']
                ];
            });

            return $mapped;
        }

        return null;
    }
}