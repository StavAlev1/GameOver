<?php

namespace App\Http\Controllers;

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
        return response()->json([
            'pickup_postcode' => request('pickup_postcode'),
            'delivery_postcode' => request('delivery_postcode'),
            'vehicle' => request('vehicle'),
            'price' => $this->service->priceCalc(request()->all())
        ]);
    }
}
