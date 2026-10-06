<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::ordered()->get();
        $skills = Skill::ordered()->get();
        $experiences = Experience::ordered()->get();

        return view('home', compact('projects', 'skills', 'experiences'));
    }
}
