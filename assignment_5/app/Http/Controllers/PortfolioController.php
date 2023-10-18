<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{

    public function home()
    {
        $avatar = File::json(storage_path('data/resume.json'))['profile']['avatar'];
        return view('portfolio.index', compact('avatar'));
    }

    public function about()
    {
        $profile = File::json(storage_path('data/resume.json'))['profile'];
        return view('portfolio.about', compact('profile'));
    }

    public function resume()
    {
        $experiences = File::json(storage_path('data/resume.json'))['work_experience'];
        return view('portfolio.resume', compact('experiences'));
    }

    public function portfolio()
    {
        $projects = File::json(storage_path('data/resume.json'))['projects'];
        return view('portfolio.portfolio', compact('projects'));
    }

    public function portfolioDetails(int $id)
    {
        
        $project = null;
        $projects = File::json(storage_path('data/resume.json'))['projects'];
        // dd($projects[0]['id']);
        foreach(File::json(storage_path('data/resume.json'))['projects'] as $item){
            if($item['id'] === $id){
                $project = $item;
            }
            
        }
        // return $project;
        return view('portfolio.portfolio_details', compact('project'));
    }

    public function service()
    {
        return view('portfolio.service');
    }

    public function contact()
    {
        return view('portfolio.contact');
    }
}
