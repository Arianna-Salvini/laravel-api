<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('types', 'technologies')->orderByDesc('id')->paginate(4);

        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }
}
