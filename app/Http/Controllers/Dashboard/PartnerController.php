<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(): View
    {
        $partners = Partner::orderBy('position')->orderBy('id')->get();

        return view('dashboard.partners.index', compact('partners'));
    }

    public function create(): View
    {
        return view('dashboard.partners.form', ['partner' => new Partner(['is_published' => true])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $partner = new Partner();
        $this->fill($partner, $this->validateData($request))->save();
        $this->handleLogo($request, $partner);

        return redirect()->route('dashboard.partners.index')->with('status', 'Partner created.');
    }

    public function edit(Partner $partner): View
    {
        return view('dashboard.partners.form', compact('partner'));
    }

    public function update(Request $request, Partner $partner): RedirectResponse
    {
        $this->fill($partner, $this->validateData($request))->save();
        $this->handleLogo($request, $partner);

        return redirect()->route('dashboard.partners.index')->with('status', 'Partner updated.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();

        return redirect()->route('dashboard.partners.index')->with('status', 'Partner deleted.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['array'], 'name.en' => ['required', 'string', 'max:255'], 'name.ar' => ['nullable', 'string', 'max:255'],
            'tag' => ['array'], 'tag.en' => ['nullable', 'string', 'max:255'], 'tag.ar' => ['nullable', 'string', 'max:255'],
            'region' => ['array'], 'region.en' => ['nullable', 'string', 'max:255'], 'region.ar' => ['nullable', 'string', 'max:255'],
            'body' => ['array'], 'body.en' => ['nullable', 'string'], 'body.ar' => ['nullable', 'string'],
            'services_en' => ['nullable', 'string'],
            'services_ar' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'max:5120'],
        ]);
    }

    protected function fill(Partner $partner, array $data): Partner
    {
        $partner->name = $data['name'];
        $partner->tag = $data['tag'] ?? [];
        $partner->region = $data['region'] ?? [];
        $partner->body = $data['body'] ?? [];
        $partner->services = [
            'en' => $this->lines($data['services_en'] ?? ''),
            'ar' => $this->lines($data['services_ar'] ?? ''),
        ];
        $partner->website = $data['website'] ?? null;
        $partner->position = $data['position'] ?? 0;
        $partner->is_published = (bool) ($data['is_published'] ?? false);

        return $partner;
    }

    protected function handleLogo(Request $request, Partner $partner): void
    {
        if ($request->hasFile('logo')) {
            $partner->clearMediaCollection('logo');
            $partner->addMediaFromRequest('logo')->toMediaCollection('logo');
        }
    }

    protected function lines(string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))->map(fn ($l) => trim($l))->filter()->values()->all();
    }
}
