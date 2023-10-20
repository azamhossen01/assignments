<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{

    public function home()
    {
        if(file_exists(storage_path('data/resume.json'))){
            $avatar = File::json(storage_path('data/resume.json'))['profile']['avatar'];
            return view('portfolio.index', compact('avatar'));
        }else{
            return "File does not exists";
        }
        
    }

    public function about()
    {
        if(file_exists(storage_path('data/resume.json'))){
            $profile = File::json(storage_path('data/resume.json'))['profile'];
            return view('portfolio.about', compact('profile'));
        }else{
            return "File does not exists";
        }
        
    }

    public function resume()
    {
        if(file_exists(storage_path('data/resume.json'))){
            $experiences = File::json(storage_path('data/resume.json'))['work_experience'];
            return view('portfolio.resume', compact('experiences'));
        }else{
            return "File does not exists";
        }
    }

    public function portfolio()
    {
        if(file_exists(storage_path('data/resume.json'))){
            $projects = File::json(storage_path('data/resume.json'))['projects'];
            return view('portfolio.portfolio', compact('projects'));
        }else{
            return "File does not exists";
        }
        
    }

    public function portfolioDetails(int $id)
    {
        
        $project = null;
        if(file_exists(storage_path('data/resume.json'))){
            $projects = File::json(storage_path('data/resume.json'))['projects'];
            foreach(File::json(storage_path('data/resume.json'))['projects'] as $item){
                if($item['id'] === $id){
                    $project = $item;
                }
                
            }
            return view('portfolio.portfolio_details', compact('project'));
        }else{
            return "File does not exists";
        }
        
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
