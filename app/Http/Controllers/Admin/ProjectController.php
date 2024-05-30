<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', ['projects' =>Project::orderByDesc('id')->paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types=Type::all();
        $technologies=Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());
        
        $validated= $request -> validated();
        $slug= Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        if ($request->has('image')){
            $image_path=Storage::put('uploads', $validated['image']);
            $validated['image']=$image_path;
        };

        $project = Project::create($validated);

        if($request->has('technologies')){
            $project->technologies()->attach($validated['technologies']);
        }
        
        // dd($validated, $image_path);
        // dd($validated);


        return to_route('admin.projects.index')->with('message', 'Project added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project) 
    {
        return view('admin/projects/show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types=Type::all();
        $technologies=Technology::all();
        
        
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // dd($request->all());

        $validated= $request->validated();
        $slug= Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        if ($request->has('image')){
            $image_path=Storage::put('uploads', $validated['image']);
            $validated['image']=$image_path;
        }

        $project->update($validated);

        if($request->has('technologies')){
            $project->technologies()->sync($validated['technologies']);
        }else{
            $project->technologies()->sync([]);
        }

        return to_route('admin.projects.show', $project)->with('status', "Project  $project->title updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if($project->image){
            Storage::delete($project->image);
        };
        $project->technologies()->detach();
        $project->delete();
        
        return  to_route('admin.projects.index')->with('status', "Project  $project->title DELETED successfully");
    }
}
