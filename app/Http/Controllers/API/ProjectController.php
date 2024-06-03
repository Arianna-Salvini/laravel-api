<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->orderByDesc('id')->paginate(4);

        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }

    public function show($slug)
    {

        $project = Project::with('technology', 'type')->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'response' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => '404 no projects fund, sorry!',
            ]);
        }

    }
}
