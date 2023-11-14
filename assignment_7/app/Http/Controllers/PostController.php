<?php

namespace App\Http\Controllers;

use Faker\Core\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:1000',
            'image' => 'image|mimes:png,jpg|size:1024'
        ],[
            'description.required' => 'বর্ণনা অবশ্যই দিতে হবে।',
            'description.max' => 'সর্বোচ্চ ১০০০ এর বেশি দিতে পারবে না'
            
        ]);
        $post = DB::table('posts')->insert([
            'user_id' => Auth::id(),
            'uuid' => Str::uuid(),
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        Alert::success('Success Title', 'Post created successfully');
        return redirect()->back();
    }

    public function show($uuid)
    {
        $post = DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.name as author', 'users.username')
        ->where('uuid', $uuid)
        ->first();
        return view('pages.posts.show', compact('post'));
    }

    public function edit($uuid)
    {
        $post = DB::table('posts')
        ->where('uuid', $uuid)
        ->where('user_id', Auth::id())
        ->first();
        return view('pages.posts.edit', compact('post'));
    }

    public function update(Request $request, $uuid)
    {
        $request->validate([
            'description' => 'required|max:1000',
            'image' => 'image|mimes:png,jpg|size:1024'
        ]);
        DB::table('posts')
        ->where('uuid', $uuid)
        ->where('user_id', Auth::id())
        ->update([
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);
        Alert::success('Success Title', 'Post updated successfully');
        return redirect()->back();
    }

    public function destroy($uuid)
    {
        $post = DB::table('posts')->where([
            'user_id' => Auth::id(),
            'uuid' => $uuid
        ])->delete();
        Alert::success('Success Title', 'Post deleted successfully');
        return redirect()->back();
    }
}
