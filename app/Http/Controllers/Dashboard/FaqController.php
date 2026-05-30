<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public const CATEGORIES = ['Setup', 'Costs', 'Regulation', 'After'];

    public function index(): View
    {
        $faqs = Faq::orderBy('position')->orderBy('id')->get()->groupBy('category');

        return view('dashboard.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('dashboard.faqs.form', ['faq' => new Faq(['is_published' => true]), 'categories' => self::CATEGORIES]);
    }

    public function store(Request $request): RedirectResponse
    {
        Faq::create($this->validated($request));

        return redirect()->route('dashboard.faqs.index')->with('status', 'FAQ added.');
    }

    public function edit(Faq $faq): View
    {
        return view('dashboard.faqs.form', ['faq' => $faq, 'categories' => self::CATEGORIES]);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $faq->update($this->validated($request));

        return redirect()->route('dashboard.faqs.index')->with('status', 'FAQ updated.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('dashboard.faqs.index')->with('status', 'FAQ deleted.');
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'question' => ['array'], 'question.en' => ['required', 'string'], 'question.ar' => ['nullable', 'string'],
            'answer' => ['array'], 'answer.en' => ['required', 'string'], 'answer.ar' => ['nullable', 'string'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['is_published'] = (bool) ($request->input('is_published'));
        $data['position'] = $data['position'] ?? 0;

        return $data;
    }
}
