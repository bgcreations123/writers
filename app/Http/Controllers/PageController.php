<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\{Page};

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request, $slug){
    	// $slug = substr(strrchr(url()->current(),"/"),1);

    	// dd($slug);

    	$page = Page::where([['slug', $slug], ['status', 'ACTIVE']])->firstOrFail();

    	return view('home.page', compact('page'));
    }

}