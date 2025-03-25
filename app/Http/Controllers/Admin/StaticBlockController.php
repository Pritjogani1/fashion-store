<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaticBlockController extends Controller
{
    public function index()
    {
        $blocks = StaticBlock::all();
        return view('admin.static-blocks.index', compact('blocks'));
    }

    public function create()
    {
        return view('admin.static-blocks.create');
    }

    public function store(Request $request)
    {
       
        // $request->validate([
        //     'slug' => 'required|unique:static_blocks',
        //     'title' => 'required',
        //     'content' => 'required',
        //     'is_active' => 'required|boolean',
        // ]);

        StaticBlock::create([
          'title' =>  $request->title,
         'slug' =>   Str::slug($request->title),
           'content' => $request->content,
           'content' => $request->content,
         'is_active' =>  $request->is_active
        ]);
        return redirect()->route('admin.static-blocks.index')->with('success', 'Block created successfully');
    }

    public function edit(StaticBlock $block)
    {
        return view('admin.static-blocks.edit', compact('block'));
    }

    public function update(Request $request, StaticBlock $block)
    {
        // $request->validate([
        //     'identifier' => 'required|unique:static_blocks,identifier,'.$block->id,
        //     'title' => 'required',
        //     'content' => 'required',
        // ]);

        $block->update(
            [
                'title' =>  $request->title,
                'slug' =>   Str::slug($request->title),
                  'content' => $request->content,
                'is_active' =>  $request->is_active
                
            ]
        );
        return redirect()->route('admin.static-blocks.index')->with('success', 'Block updated successfully');
    }

    public function destroy(StaticBlock $block)
    {
        $block->delete();
        return redirect()->route('admin.static-blocks.index')->with('success', 'Block deleted successfully');
    }
}