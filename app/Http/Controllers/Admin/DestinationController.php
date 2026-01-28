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
        $query = Destination::query();

        $request->whenFilled('search', function ($search) use ($query) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        $destinations = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('admin.destinations.index', compact('destinations'));
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
