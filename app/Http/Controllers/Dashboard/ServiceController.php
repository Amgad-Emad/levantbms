<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::withCount('subServices')->orderBy('position')->orderBy('id')->get();

        return view('dashboard.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('dashboard.services.form', ['service' => new Service(['is_published' => true, 'category' => 'moic'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->fill(new Service(), $this->validateData($request))->save();

        return redirect()->route('dashboard.services.index')->with('status', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('dashboard.services.form', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->fill($service, $this->validateData($request))->save();

        return redirect()->route('dashboard.services.index')->with('status', 'Service updated — changes are live.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('dashboard.services.index')->with('status', 'Service deleted.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'code' => ['nullable', 'string', 'max:10'],
            'tag' => ['array'], 'tag.en' => ['nullable', 'string', 'max:255'], 'tag.ar' => ['nullable', 'string', 'max:255'],
            'title' => ['array'], 'title.en' => ['required', 'string', 'max:255'], 'title.ar' => ['nullable', 'string', 'max:255'],
            'description' => ['array'], 'description.en' => ['nullable', 'string'], 'description.ar' => ['nullable', 'string'],
            'timeline' => ['array'], 'timeline.en' => ['nullable', 'string', 'max:120'], 'timeline.ar' => ['nullable', 'string', 'max:120'],
            'fee_from' => ['array'], 'fee_from.en' => ['nullable', 'string', 'max:120'], 'fee_from.ar' => ['nullable', 'string', 'max:120'],
            'scope_en' => ['nullable', 'string'],
            'scope_ar' => ['nullable', 'string'],
            'position' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);
    }

    protected function fill(Service $service, array $data): Service
    {
        $service->code = $data['code'] ?? null;
        // Category is fixed per main service and not edited here — preserved as-is
        // (new services fall back to the DB default 'moic').
        $service->tag = $data['tag'] ?? [];
        $service->title = $data['title'];
        $service->description = $data['description'] ?? [];
        $service->timeline = $data['timeline'] ?? [];
        $service->fee_from = $data['fee_from'] ?? [];
        $service->scope_lines = [
            'en' => $this->lines($data['scope_en'] ?? ''),
            'ar' => $this->lines($data['scope_ar'] ?? ''),
        ];
        $service->position = $data['position'] ?? 0;
        $service->is_published = (bool) ($data['is_published'] ?? false);

        return $service;
    }

    /** Split a textarea (one item per line) into a clean array. */
    protected function lines(string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(fn ($l) => trim($l))
            ->filter()
            ->values()
            ->all();
    }
}
