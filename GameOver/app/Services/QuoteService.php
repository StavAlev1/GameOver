<?php

namespace App\Services;


class QuoteService
{
    public function priceCalc($request): int
    {
        $sub = (base_convert($request['pickup_postcode'], 36, 10) - 
        base_convert($request['delivery_postcode'], 36, 10));

        $intSub = intval($sub / 100000000);

        $vehicleMarkup = $this->vehicleMarkup($intSub , $request['vehicle']) ?? 0;

        return $intSub + $vehicleMarkup;
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

}