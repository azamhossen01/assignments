<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{

    public function home()
    {
        if(file_exists(storage_path('data/profile.json'))){
            
            $avatar = File::json(storage_path('data/profile.json'))["avatar"];
            return view('portfolio.index', compact('avatar'));
        }else{
            return "File does not exists";
        }
        
    }

    public function about()
    {
        if(file_exists(storage_path('data/profile.json'))){
            $profile = File::json(storage_path('data/profile.json'));
            return view('portfolio.about', compact('profile'));
        }else{
            return "File does not exists";
        }
        
    }

    public function resume()
    {
        if(file_exists(storage_path('data/experience.json'))){
            $experiences = File::json(storage_path('data/experience.json'))['work_experience'];
            return view('portfolio.resume', compact('experiences'));
        }else{
            return "File does not exists";
        }
    }

    public function portfolio()
    {
        if(file_exists(storage_path('data/portfolio.json'))){
            $portfolios = File::json(storage_path('data/portfolio.json'))['portfolios'];
            return view('portfolio.portfolio', compact('portfolios'));
        }else{
            return "File does not exists";
        }
        
    }

    public function details(int $id)
    {
        
        $portfolio = null;
        if(file_exists(storage_path('data/portfolio.json'))){
            $portfolios = File::json(storage_path('data/portfolio.json'))['portfolios'];
            foreach($portfolios as $item){
                if($item['id'] === $id){
                    $portfolio = $item;
                }
                
            }
            return view('portfolio.portfolio_details', compact('portfolio'));
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
