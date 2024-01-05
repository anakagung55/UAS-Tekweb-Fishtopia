<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Centre_Point;
use App\Models\Spot;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $centerPoint = Centre_Point::get()->first();
        $spot = Spot::get();
        return view('home', [
            'featuredPosts' => Post::published()->featured()->latest('published_at')->take(3)->get(),
            'latestPosts' => Post::published()->latest('published_at')->take(9)->get(),
            'centerPoint' => $centerPoint,
            'spot' => $spot 
        ]);
    }

    public function detailSpot($slug)
    {
        $spot = Spot::where('slug',$slug)->first();
        return view('detail',[
            'spot' => $spot,
            'featuredPosts' => Post::published()->featured()->latest('published_at')->take(3)->get(),
            'latestPosts' => Post::published()->latest('published_at')->take(9)->get(),
        ]);
    }
}