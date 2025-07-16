<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Review;
use App\Models\TrySub;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\NewsletterSubscriber;
use App\Models\ReviewComments;
use App\Models\SubComment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    
    
    public function register(Request $request)
    {
        // Validate the form data
        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users',
        //     'phone' => 'required|string',
        //     'password' => 'required|string',
        // ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // You may want to authenticate the user here
        // For simplicity, I'm assuming registration is successful
       return redirect('/')->with('message', 'Registration successful');
    }

    public function login_data(Request $request)
    {
        // Validate the form data
        $request->validate([
            'logemail' => 'required|email',
            'logpass' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->logemail, 'password' => $request->logpass])) {
            // Authentication successful
            return redirect()->intended('/');
        }

        // Authentication failed
        return redirect()->back()->with('error', 'Invalid credentials');
    }

  public function search(Request $request)
    {
        $query = $request->input('query');
        $blogs = Blog::where('title', 'like', "%$query%")
            ->orWhere('title_url', 'like', "%$query%")
            ->get();

        return view('blog_search', compact('blogs','query'));
    }
    
    public function index()
    {
        $blogs = Blog::paginate(10); // Paginate with 5 items per page
        $footerData = Blog::inRandomOrder()->take(3)->get();
        return view('blog_listing', compact('blogs','footerData'));
    }
    public function contact()
    {
        $footerData = Blog::inRandomOrder()->take(3)->get();
        return view('contact', compact('footerData'));
    }
    public function about()
    {
        $footerData = Blog::inRandomOrder()->take(3)->get();
        return view('about', compact('footerData'));
    }
    public function privacy()
    {
        $footerData = Blog::inRandomOrder()->take(3)->get();
        return view('privacy', compact('footerData'));
    }
    
    public function review()
    {
       $reviews = Review::paginate(10); // Paginate with 5 items per page
         $footerData = Blog::inRandomOrder()->take(3)->get();
         return view('review_listing', compact('reviews','footerData'));
       // return view('review_listing',compact('reviews'));
    }
    
    
    // public function subscribe(Request $request)
    
    // {
    //     dd($request->all());
    // }

    // public function show($title_url)
    // {
    //     // Decode the title_url back to its original form
    //     $title = $title_url;

    //     // Find the blog by title_url
    //     $blog = Blog::where('title_url', $title)->firstOrFail();

    //     return view('blog_show', ['blog' => $blog]);s
    // }

    // public function show($title_url)
    // {
    //     // Decode the title_url back to its original form
    //     $title = $title_url;

    //     // Find the blog by title_url
    //     $blog = Blog::where('title_url', $title)->firstOrFail();
    //     $popularSection = Blog::inRandomOrder()->take(5)->get();
    //     // Load comments and subcomments for the blog post
    //     $comments = Comment::where('blog_id', $blog->id)->with('subComments')->get();

    //     return view('blog_show', compact('blog', 'comments', 'popularSection'));
    // }
    
  public function show($category, $title_url)
{
    // Find the blog by both category and title_url
    $blog = Blog::where('category', $category)
                ->where('title_url', $title_url)
                ->firstOrFail();

    $popularSection = Blog::inRandomOrder()->take(5)->get();
    $comments = Comment::where('blog_id', $blog->id)->with('subComments')->get();

    return view('blog_show', compact('blog', 'comments', 'popularSection'));
}



    
    
        public function review_show($title_url)
        {
            $review = Review::where('title_url', $title_url)->firstOrFail();
            $popularSection = Review::inRandomOrder()->take(5)->get();
            $review_comments = ReviewComments::where('review_id', $review->id)->get();
            $average_rating = intval($review_comments->avg('ratings'));
       


            return view('review_show', compact('review','popularSection','review_comments','average_rating'));
        }

    public function create()
    {
        return view('admin_panel.blog_insert');
    }
    
  
    public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'title' => 'required|max:1000',
            'title_url' => 'required|max:1000|unique:blogs',
            'meta_title' => 'max:1000',
            'meta_desc' => 'max:1000',
            'meta_key' => 'max:1000',
            'description' => 'max:1000',
            'category' => 'nullable|max:1000', // Allow null values for category and auth_name
            'auth_name' => 'nullable|max:1000',
            'body' => 'required',
            'img_url' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'post_code' => 'max:10',
        ]);

        // dd($validatedData);
        // Handle image upload
   
    if ($request->hasFile('img_url')) {
    $image = $request->file('img_url');
    $imagePath = $image->store('blog_images', 'public'); // Store in 'storage/app/public/blog_images'
    $imageUrl = url('storage/app/public/' . $imagePath); // Generate URL with '/storage/' prefix
    $validatedData['img_url'] = $imageUrl;
}



        $blog = Blog::create($validatedData);

    // Notify subscribers about the new blog post
   

        return redirect()->route('admin_panel.blogs.create')->with('success', 'Blog post created successfully.');
    }
    
      
      private function sendNotificationToSubscribers($blog)
{
    // Fetch all subscriber emails
    $subscribers = TrySub::pluck('email')->toArray();
    
    // Email subject and message
    $subject = "New Blog Post: " . $blog->title;
    $message = $blog->body; // or $blog->description, depending on what content you want to include

    // Send email to each subscriber
    foreach ($subscribers as $subscriber) {
        Mail::raw($message, function ($mail) use ($subject, $subscriber) {
            $mail->to($subscriber)
                 ->subject($subject);
        });
    }
}
      
    public function review_create()
    {
        return view('admin_panel.review_insert');
    }
  
    public function review_store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:1000',
            'title_url' => 'max:1000|unique:blogs',
            'meta_title' => 'max:1000',
            'meta_desc' => 'max:1000',
            'meta_key' => 'max:1000',
            'description' => 'max:1000',
            'category' => 'nullable|max:1000', // Allow null values for category and auth_name
            'auth_name' => 'nullable|max:1000',
            'body' => 'required',
            'img_url' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'post_code' => 'max:10',
        ]);

        // dd($validatedData);
        // Handle image upload
        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $imagePath = $image->store('review_images', 'public'); // Specify the directory and disk
            $imageUrl = url('storage/app/public/' . $imagePath); // Generate URL with '/storage/' prefix
            $validatedData['img_url'] = $imageUrl;
        }
        

        Review::create($validatedData);

        return redirect()->route('admin_panel.review.create')->with('success', 'Review created successfully.');
    }



   public function show_reviews() 
    {
        $reviews = Review::paginate(20);
        return view('admin_panel.review_show', compact('reviews'));
    }



   public function review_update($id)
    {
        $review = Review::findOrFail($id);
        return view('admin_panel.review_show_update', ['review' => $review]);
    }
    
     public function review_update_data(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:1000',
            'title_url' => 'required|max:1000',
            'meta_title' => 'max:1000',
            'meta_desc' => 'required|max:1000',
            'meta_key' => 'required|max:1000',
            'category' => 'max:1000',
            'auth_name' => 'max:1000',
            'description' => 'required',
            'body' => 'required',
            'new_img_url' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust the file validation rules as needed
        ]);

        $review = Review::findOrFail($id);

        // Check if a new image is uploaded
        if ($request->hasFile('new_img_url')) {
            // Delete the old image
            Storage::delete($review->img_url);

            // Store the new image
            $imagePath = $request->file('new_img_url')->store('review_images');

            // Update the image URL in the database
            $review->img_url = $imagePath;
        }

        // Update other fields
        $review->title = $request->input('title');
        $review->title_url = $request->input('title_url');
        $review->meta_title = $request->input('meta_title');
        $review->meta_desc = $request->input('meta_desc');
        $review->meta_key = $request->input('meta_key');
        $review->auth_name = $request->input('auth_name');
        $review->category = $request->input('category');
        $review->description = $request->input('description');
        $review->body = $request->input('body');

        // Save the changes
        $review->save();

        return redirect('admin_panel/show_reviews')->with('success', 'Review  updated successfully.');
    }
    
    
       public function review_delete($id)
    {
        // Find the blog by ID
        $review = Review::findOrFail($id);

        // Delete the blog
        $review->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }

    
    // Controller method
    public function show_blogs() 
    {
        $blogs = Blog::paginate(20);
        return view('admin_panel.blog_show', compact('blogs'));
    }

    public function show_update($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin_panel.blog_show_update', ['blog' => $blog]);
    }

    public function show_update_data(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'title_url' => 'required|max:255',
            'meta_title' => 'max:1000',
            'meta_desc' => 'required|max:255',
            'meta_key' => 'required|max:255',
            'category' => 'max:255',
            'auth_name' => 'max:255',
            'description' => 'required',
            'body' => 'required',
            'new_img_url' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust the file validation rules as needed
        ]);

        $blog = Blog::findOrFail($id);

        // Check if a new image is uploaded
        if ($request->hasFile('new_img_url')) {
            // Delete the old image
            Storage::delete($blog->img_url);

            // Store the new image
            $imagePath = $request->file('new_img_url')->store('blog_images', 'public');
              $imageUrl = url('storage/app/public/' . $imagePath);
            // Update the image URL in the database
            $blog->img_url = $imageUrl;
        }

        // Update other fields
        $blog->title = $request->input('title');
        $blog->title_url = $request->input('title_url');
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_desc = $request->input('meta_desc');
        $blog->meta_key = $request->input('meta_key');
        $blog->auth_name = $request->input('auth_name');
        $blog->category = $request->input('category');
        $blog->description = $request->input('description');
        $blog->body = $request->input('body');

        // Save the changes
        $blog->save();

        return redirect()->back()->with('success', 'Blog post updated successfully.');
    }

    public function show_delete($id)
    {
        // Find the blog by ID
        $blog = Blog::findOrFail($id);

        // Delete the blog
        $blog->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Blog deleted successfully.');
    }

    public function admin_login()
    {
        return view('admin_panel.login');
    }

  public function admin_login_verify(Request $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Retrieve the admin with the provided username
        $admin = Admin::where('username', $request->username)->first();

        // Check if admin exists and password matches
        if ($admin && $admin->password === $request->password) {
            // Admin credentials are correct, create a session
            $request->session()->put('admin', $admin);

            // Redirect to the create blog page
            return redirect()->route('admin_panel.blogs.create');
        } else {
            // Admin credentials are incorrect, redirect back with error message
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    } catch (\Exception $e) {
        // Log the error for further analysis
        \Log::error('Admin Login Error: ' . $e->getMessage());

        // Redirect back with the error message
        return redirect()->back()->with('error', 'An error occurred during login. Please try again later.');
    }
}

    public function admin_logout()
    {
        // Forget the 'admin' session variable
        Session::forget('admin');

        // Redirect to a specific page after logout (optional)
        return redirect()->route('admin_panel.login')->with('success', 'Logged out successfully.');
    }

    public function store_comment(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
            'blog_id' => 'required',
        ]);

        // Create a new comment
        Comment::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'comment' => $validatedData['comment'],
            // You might need to adjust the blog_id based on your application's logic
            'blog_id' => $validatedData['blog_id'],
        ]);

        // Redirect back to the blog post or any other page
        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function store_review_comment(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
            'rating_number' => 'required',
            'review_id' => 'required',
        ]);

        // Create a new comment
        ReviewComments::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'comment' => $validatedData['comment'],
            'ratings' => $validatedData['rating_number'],
            // You might need to adjust the blog_id based on your application's logic
            'review_id' => $validatedData['review_id'],
        ]);

        // Redirect back to the blog post or any other page
        return redirect()->back()->with('success', 'Review comment posted successfully.');
    }

    public function storeReply(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
            'comment_id' => 'required|exists:comments,id', // Ensure the parent comment exists
        ]);

        // Create a new subcomment
        SubComment::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'comment' => $validatedData['comment'],
            'comment_id' => $validatedData['comment_id'], // Set the parent comment's ID
        ]);

        // Redirect back to the page (you can adjust this based on your application's logic)
        return redirect()->back()->with('success', 'Reply posted successfully.');
    }

    public function home_blog() 
    {
        // Fetch three random blog data
        
        // $reviews = Review::paginate(10);
    $latestReviews = Review::with('reviewComments')
    ->orderBy('created_at', 'desc')
    ->take(6)
    ->get()
    ->map(function ($review) {
        $review->average_rating = $review->reviewComments()->avg('ratings');
        return $review;
    });
        
        $blogs = Blog::inRandomOrder()->take(3)->get();
        $blogs_1 = Blog::inRandomOrder()->first(); // No need to use take(1), first() will suffice
        $blogs_2 = Blog::inRandomOrder()->take(2)->get();
        $blogs_10 = Blog::inRandomOrder()->take(5)->get();
        $blogs_5 = Blog::inRandomOrder()->take(5)->get();
      
        $streamingMain = Blog::where('category', 'streaming')->inRandomOrder()->first();
        $streamingSection = Blog::where('category', 'streaming')->inRandomOrder()->take(4)->get();
       
        $technologyMain = Blog::whereIn('category', ['scam', 'printer', 'email', 'activation', 'antivirus', 'outage', 'phone'])->inRandomOrder()->first();
        $technologySection = Blog::whereIn('category', ['scam', 'printer', 'email', 'activation', 'antivirus', 'outage', 'phone'])->inRandomOrder()->take(4)->get();
       
        $technologyMain2 = Blog::whereIn('category', ['scam', 'printer', 'email', 'activation', 'antivirus', 'outage', 'phone'])->inRandomOrder()->first();
        $technologySection2 = Blog::whereIn('category', ['scam', 'printer', 'email', 'activation', 'antivirus', 'outage', 'phone'])->inRandomOrder()->take(4)->get();
       
        $popularMain = Blog::inRandomOrder()->first(); 
        $popularSection = Blog::inRandomOrder()->take(4)->get();
        
        $networkMain = Blog::whereIn('category', ['network'])->inRandomOrder()->first();
        $networkSection = Blog::whereIn('category', ['network'])->inRandomOrder()->take(3)->get();

        // $lifeStyleMain = Blog::whereIn('category', ['work', 'meme', 'fitness', 'games', 'refund', 'email', 'phone'])->inRandomOrder()->first();
        // $lifeStyleSection = Blog::whereIn('category', ['work', 'meme', 'fitness', 'games', 'refund', 'email', 'phone'])->inRandomOrder()->take(3)->get();
      
        $lifeStyleMain = Blog::whereIn('category', ['streaming'])->inRandomOrder()->first();
        $lifeStyleSection = Blog::whereIn('category', ['streaming'])->inRandomOrder()->take(3)->get();
        $healthMain = Blog::whereIn('category', ['streaming'])->inRandomOrder()->first();
        $healthSection = Blog::whereIn('category', ['streaming'])->inRandomOrder()->take(3)->get();
       
        // $healthMain = Blog::whereIn('category', ['games', 'meme', 'fitness'])->inRandomOrder()->first();
        // $healthSection = Blog::whereIn('category', ['games', 'meme', 'fitness'])->inRandomOrder()->take(3)->get();
       
        $trendingStream = Blog::inRandomOrder()->first();
        $trendingStream2 = Blog::inRandomOrder()->first();
        $footerData = Blog::inRandomOrder()->take(3)->get();

        $viewMoreItem1 = Blog::inRandomOrder()->take(5)->get();
        $viewMoreItem2 = Blog::inRandomOrder()->take(5)->get();
        $viewMoreItem3 = Blog::inRandomOrder()->take(5)->get();
        $viewMoreItem4 = Blog::inRandomOrder()->take(5)->get();
        return view('index', compact(
            'streamingMain', 'streamingSection', 'latestReviews',
            'technologyMain', 'technologySection', 
            'technologyMain2', 'technologySection2', 
            'popularMain', 'popularSection', 
            'trendingStream', 'trendingStream2', 
            'networkMain', 'networkSection', 
            'lifeStyleMain', 'lifeStyleSection', 
            'healthMain', 'healthSection', 'footerData',
            'blogs', 'blogs_1', 'blogs_2', 'blogs_10', 'blogs_5',
            'viewMoreItem1', 'viewMoreItem2', 'viewMoreItem3', 'viewMoreItem4'
        ));
        
    }
    
    public function login(){
        return view('login');
    }
    public function signup(){
        return view('register');
    }
}
