<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();
        return view('admin.technologies.create', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $technology = Technology::create($data);

        return redirect()->route('admin.technologies.show', $technology);
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->all();
        $technology -> update($data);
        return redirect(route('admin.technologies.show', $technology));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index');
    }

    public function deletedIndex(){
        $technologies = Technology::onlyTrashed()->get();
        return view('admin.technologies.deleted-index', compact('technologies'));
    }

    public function deletedRestore(string $id){
        $technology = Technology::withTrashed()->where('id', $id)->first();
        $technology->restore();

        return redirect()->route('admin.technologies.index', $technology);
    }

    public function deletedDestroy(string $id){
        $technology = Technology::withTrashed()->where('id', $id)->first();
        $technology->forceDelete();

        return redirect()->route('admin.technologies.deleted.index');
    }
}
