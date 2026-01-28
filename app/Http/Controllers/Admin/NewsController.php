<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Services\Admin\NewsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function __construct(private NewsService $newsService)
    {
    }

    public function index(Request $request): View
    {
        $newsItems = $this->newsService->getNews($request->all());
        $categories = Category::where('type', 'NEWS')->get();

        return view('admin.news.index', compact('newsItems', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'NEWS')->get();
        return view('admin.news.createOrEdit', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Inline Validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where('type', 'NEWS')
            ],
            'thumbnail' => 'nullable|string',
            'priority' => 'nullable|integer',
            'short_description' => 'nullable|string',
            'contents' => 'nullable|string',
        ], [
            'category_id.exists' => 'Danh mục được chọn không hợp lệ hoặc không phải là danh mục tin tức.'
        ]);

        $this->newsService->createNews($validatedData);

        return redirect()->route('admin.news.index')->with('success', 'Tạo mới tin tức thành công.');
    }

    public function edit(News $news): View
    {
        $categories = Category::where('type', 'NEWS')->get();
        return view('admin.news.createOrEdit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        // Inline Validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where('type', 'NEWS')
            ],
            'thumbnail' => 'nullable|string',
            'priority' => 'nullable|integer',
            'short_description' => 'nullable|string',
            'contents' => 'nullable|string',
        ], [
            'category_id.exists' => 'Danh mục được chọn không hợp lệ hoặc không phải là danh mục tin tức.'
        ]);

        $this->newsService->updateNews($news, $validatedData);

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Xóa tin tức thành công.');
    }

}
