<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    /** Category order (keys map to the bilingual lang labels faqs.cat*). */
    public const CATEGORIES = ['Setup', 'Costs', 'Regulation', 'After'];

    public function index(): View
    {
        $grouped = Faq::where('is_published', true)
            ->orderBy('position')->orderBy('id')->get()
            ->groupBy('category');

        // Preserve the canonical category order, dropping empty categories.
        $grouped = collect(self::CATEGORIES)
            ->mapWithKeys(fn ($cat) => [$cat => $grouped->get($cat, collect())])
            ->filter(fn ($rows) => $rows->isNotEmpty());

        return view('front.faqs', compact('grouped'));
    }
}
