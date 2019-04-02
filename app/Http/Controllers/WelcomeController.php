<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{PaperPeriod, PaperClassification, Product};

class WelcomeController extends Controller
{
    public function welcome()
    {
        $paperPeriods = PaperPeriod::all('period', 'id');
        $classifications = PaperClassification::all('classification', 'id');

        
        return view('welcome', compact('paperPeriods', 'classifications'));

    }

    public function getProduct($cid, $pid)
    {
        $product = Product::where([['classification_id', $cid], ['period_id', $pid]])->pluck('price','id');
        // dd($product);

        return json_encode($product);
    }
}
