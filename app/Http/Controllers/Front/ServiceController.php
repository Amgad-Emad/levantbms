<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::where('is_published', true)
            ->with(['subServices' => fn ($q) => $q->where('is_published', true)->orderBy('position')->orderBy('id')])
            ->orderByDesc('category') // 'moic' before 'cbb'
            ->orderBy('position')->orderBy('id')->get();

        return view('front.services', compact('services'));
    }
}
