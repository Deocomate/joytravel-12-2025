<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Services\Common\SlugService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function __construct(private SlugService $slugService)
    {
    }

    public function index(Request $request): View
    {
        $totalDestinations = Destination::count();
        $destinationsWithTours = Destination::whereHas('tours')->count();
        $destinationsWithoutTours = max($totalDestinations - $destinationsWithTours, 0);

        $query = Destination::query()->withCount('tours');

        $request->whenFilled('search', function ($search) use ($query) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        });

        if ($request->filled('has_tours')) {
            if ($request->input('has_tours') === 'with') {
                $query->whereHas('tours');
            }
            if ($request->input('has_tours') === 'without') {
                $query->whereDoesntHave('tours');
            }
        }

        $destinations = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('admin.destinations.index', compact(
            'destinations',
            'totalDestinations',
            'destinationsWithTours',
            'destinationsWithoutTours'
        ));
    }

    public function create(): View
    {
        return view('admin.destinations.createOrEdit');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validatedData['slug'] = $this->slugService->generate($validatedData['name'], Destination::class);
        Destination::create($validatedData);

        return redirect()->route('admin.destinations.index')->with('success', 'Tạo mới điểm đến thành công.');
    }

    public function edit(Destination $destination): View
    {
        return view('admin.destinations.createOrEdit', compact('destination'));
    }

    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validatedData['name'] !== $destination->name) {
            $validatedData['slug'] = $this->slugService->generate(
                $validatedData['name'],
                Destination::class,
                $destination->id
            );
        }

        $destination->update($validatedData);

        return redirect()->route('admin.destinations.index')->with('success', 'Cập nhật điểm đến thành công.');
    }

    public function destroy(Destination $destination): RedirectResponse
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Xóa điểm đến thành công.');
    }

}
