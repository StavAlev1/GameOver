<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function __construct(QuoteService $service)
    {
        $this->service = $service;
    }

    public function quote()
    {
        $sub = $this->service->priceCalc(request()->all());
        $priceList = $this->service->priceList(request()->all(), $sub);

        $priceList->each(function ($quote) {
            Quote::create($quote);
        });

        return response()->json([
            'pickup_postcode' => request('pickup_postcode'),
            'delivery_postcode' => request('delivery_postcode'),
            'vehicle' => request('vehicle'),
            'price_list' => $priceList
        ]);
    }
}
