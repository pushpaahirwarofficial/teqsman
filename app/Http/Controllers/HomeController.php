<?php

namespace App\Http\Controllers;
use App\Models\Review;

use Illuminate\Http\Request;
use App\Models\Blog;

class HomeController extends Controller
{
    //
    public function index()
    {
        $blogs = Blog::latest('updated_at')->take(3)->get();
        return view('index', ['blogs'=>$blogs]);
    }
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
    public function service()
    {
        return view('service');
    }
    public function blog()
    {
 $blogs = Blog::paginate(10); // Paginate with 5 items per page
        $footerData = Blog::inRandomOrder()->take(3)->get();
        return view('blog', compact('blogs','footerData'));    }
    public function blog_detail()
    {
        return view('blog-detail');
    }
     public function review()
    {
       $reviews = Review::paginate(10); // Paginate with 5 items per page
         $footerData = Blog::inRandomOrder()->take(3)->get();
         return view('review_listing', compact('reviews','footerData'));
       // return view('review_listing',compact('reviews'));
    }
    
    public function shop_product()
    {
        return view('shop_product');
    }
}
