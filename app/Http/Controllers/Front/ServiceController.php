<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_published', true)->orderBy('position')->orderBy('id')->get();

        return view('front.services', compact('services'));
    }
}
