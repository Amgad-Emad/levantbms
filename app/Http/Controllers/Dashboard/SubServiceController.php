<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\SubService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubServiceController extends Controller
{
    public function index(): View
    {
        $subServices = SubService::with('service')
            ->orderBy('service_id')
            ->orderBy('position')
            ->orderBy('id')
            ->get();

        return view('dashboard.sub-services.index', compact('subServices'));
    }

    public function create(): View
    {
        return view('dashboard.sub-services.form', [
            'subService' => new SubService(['is_published' => true]),
            'services' => $this->serviceOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->fill(new SubService(), $this->validateData($request))->save();

        return redirect()->route('dashboard.sub-services.index')->with('status', 'Sub-service created.');
    }

    public function edit(SubService $subService): View
    {
        return view('dashboard.sub-services.form', [
            'subService' => $subService,
            'services' => $this->serviceOptions(),
        ]);
    }

    public function update(Request $request, SubService $subService): RedirectResponse
    {
        $this->fill($subService, $this->validateData($request))->save();

        return redirect()->route('dashboard.sub-services.index')->with('status', 'Sub-service updated — changes are live.');
    }

    public function destroy(SubService $subService): RedirectResponse
    {
        $subService->delete();

        return redirect()->route('dashboard.sub-services.index')->with('status', 'Sub-service deleted.');
    }

    /** Parent services for the picker, keyed by id => English title. */
    protected function serviceOptions(): \Illuminate\Support\Collection
    {
        return Service::orderBy('position')->orderBy('id')->get()
            ->mapWithKeys(fn (Service $s) => [$s->id => ($s->title->get('en') ?: 'Service #'.$s->id)]);
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'service_id' => ['required', 'exists:services,id'],
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

    protected function fill(SubService $subService, array $data): SubService
    {
        $subService->service_id = $data['service_id'];
        $subService->code = $data['code'] ?? null;
        $subService->tag = $data['tag'] ?? [];
        $subService->title = $data['title'];
        $subService->description = $data['description'] ?? [];
        $subService->timeline = $data['timeline'] ?? [];
        $subService->fee_from = $data['fee_from'] ?? [];
        $subService->scope_lines = [
            'en' => $this->lines($data['scope_en'] ?? ''),
            'ar' => $this->lines($data['scope_ar'] ?? ''),
        ];
        $subService->position = $data['position'] ?? 0;
        $subService->is_published = (bool) ($data['is_published'] ?? false);

        return $subService;
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
