<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use App\Services\Admin\TourService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TourController extends Controller
{
    public function __construct(private TourService $tourService)
    {
    }

    public function index(Request $request): View
    {
        $tours = $this->tourService->getTours($request->all());
        $categories = Category::where('type', 'TOUR')->get();
        $destinations = Destination::all();

        return view('admin.tours.index', compact('tours', 'categories', 'destinations'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'TOUR')->get();
        $destinations = Destination::all();
        return view('admin.tours.createOrEdit', compact('categories', 'destinations'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Inline Validation cho STORE (không cần exceptId)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tour_code' => 'required|string|max:50|unique:tours,tour_code',
            'duration' => 'nullable|string|max:2000',
            'departure_point' => 'nullable|string|max:2000',
            'remaining_slots' => 'nullable|integer|min:0',
            'price_adult' => 'nullable|integer|min:0',
            'price_child' => 'nullable|integer|min:0',
            'price_toddler' => 'nullable|integer|min:0',
            'price_infant' => 'nullable|integer|min:0',
            'transport_mode' => 'nullable|string|max:2000',
            'thumbnail' => 'nullable|string|max:2000',
            'priority' => 'nullable|integer',
            'short_description' => 'nullable|string',
            'tour_description' => 'nullable|string',
            'tour_schedule' => 'nullable|array',
            'tour_schedule.*.title' => 'nullable|string|max:2000',
            'tour_schedule.*.content' => 'nullable|string',
            'images' => 'nullable|array',
            'services_note' => 'nullable|string',
            'note' => 'nullable|string',
            'characteristic' => 'nullable|string',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'destination_ids' => 'nullable|array',
            'destination_ids.*' => 'exists:destinations,id',
        ]);

        $this->tourService->createTour($validatedData);

        return redirect()->route('admin.tours.index')->with('success', 'Tạo mới tour thành công.');
    }

    public function edit(Tour $tour): View
    {
        $categories = Category::where('type', 'TOUR')->get();
        $destinations = Destination::all();
        $tour->load(['categories', 'destinations']);
        return view('admin.tours.createOrEdit', compact('tour', 'categories', 'destinations'));
    }

    public function update(Request $request, Tour $tour): RedirectResponse
    {
        // Inline Validation cho UPDATE (ngoại trừ ID hiện tại)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tour_code' => 'required|string|max:50|unique:tours,tour_code,' . $tour->id,
            'duration' => 'nullable|string|max:2000',
            'departure_point' => 'nullable|string|max:2000',
            'remaining_slots' => 'nullable|integer|min:0',
            'price_adult' => 'nullable|integer|min:0',
            'price_child' => 'nullable|integer|min:0',
            'price_toddler' => 'nullable|integer|min:0',
            'price_infant' => 'nullable|integer|min:0',
            'transport_mode' => 'nullable|string|max:2000',
            'thumbnail' => 'nullable|string|max:2000',
            'priority' => 'nullable|integer',
            'short_description' => 'nullable|string',
            'tour_description' => 'nullable|string',
            'tour_schedule' => 'nullable|array',
            'tour_schedule.*.title' => 'nullable|string|max:2000',
            'tour_schedule.*.content' => 'nullable|string',
            'images' => 'nullable|array',
            'services_note' => 'nullable|string',
            'note' => 'nullable|string',
            'characteristic' => 'nullable|string',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'destination_ids' => 'nullable|array',
            'destination_ids.*' => 'exists:destinations,id',
        ]);

        $this->tourService->updateTour($tour, $validatedData);

        return redirect()->route('admin.tours.index')->with('success', 'Cập nhật tour thành công.');
    }

    public function destroy(Tour $tour): RedirectResponse
    {
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Xóa tour thành công.');
    }

}
