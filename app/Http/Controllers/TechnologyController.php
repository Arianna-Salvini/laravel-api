<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies=Technology::all();
        return view('admin.technologies.technologies', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.technologies');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $validated=$request->validated();
        $slug= Str::slug($validated['name'], '-');
        $validated['slug'] = $slug;

        Technology::create($validated);

        return to_route('admin.technologies.index')->with('message', 'New technology created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.technologies', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.technologies', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $validated = $request->validated();
        $slug = Str::slug($validated['name'], '-');
        $validated['slug'] = $slug;

        $technology->update($validated);

        return to_route('admin.technologies.index')->with('message', "Technology $technology->name edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return to_route('admin.technologies.index')->with('message', "You have $technology->name technology deleted successfully");
    }
}
