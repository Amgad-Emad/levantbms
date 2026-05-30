<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $partners = Partner::where('is_published', true)->orderBy('position')->orderBy('id')->get();

        return view('front.partners', compact('partners'));
    }
}
