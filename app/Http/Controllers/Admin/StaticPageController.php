<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function index()
    {
        $pages = StaticPage::all();
        return view('admin.static-pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.static-pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:static_pages',
            'content' => 'required|string',
        ]);

        StaticPage::create($request->all());

        return redirect()->route('admin.static-pages.index')->with('success', 'Static page created successfully.');
    }

    public function edit(StaticPage $page)
    {
        return view('admin.static-pages.edit', compact('page'));
    }

    public function update(Request $request, StaticPage $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:static_pages,slug,' . $page->id,
            'content' => 'required|string',
        ]);

        $page->update($request->all());

        return redirect()->route('admin.static-pages.index')->with('success', 'Static page updated successfully.');
    }

    public function destroy(StaticPage $page)
    {
        $page->delete();

        return redirect()->route('admin.static-pages.index')->with('success', 'Static page deleted successfully.');
    }
}
