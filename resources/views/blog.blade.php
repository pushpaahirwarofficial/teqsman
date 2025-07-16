@extends('layouts.main')
@section('title', 'Blog - TeqsMan')
@section('content')



<style>
    .news-block .post-info li {
    color: #767676;
    font-size: 14px;
    font-weight: 500;
    line-height: 25px;
    margin-right: 28px!important;
    position: relative;
}

.post-info {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 15px; /* Adjust space between list items as needed */
}

.post-info li {
    display: inline;
}

.blog-title {
    display: block;
    margin-top: 10px; /* Optional: space between list and title */
    font-weight: bold;
}

.read-more {
    margin-top: 5px; /* Optional: space between title and 'Read More' link */
}

.news-block .post-info {
    position: relative;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-block!important;
    
}

.news-block .image-box .image img {
    border-radius: 10px 10px 0 0;
    display: block;
    width: 100%;
    height: 300px;
}



</style>


<section class="page-title" style="background-image: url(/public/assets/images/background/page-title.jpg);">
<div class="auto-container">
<div class="title-outer">
<h1 class="title text-center">Blog</h1>

</div>
</div>
</section>


<section class="news-section pb-70">
<div class="auto-container">
<div class="row">
    
    
    @foreach ($blogs as $blog)

    

      <div class="news-block mb-50 col-lg-4 col-md-6 wow fadeInUp mb-4">
         <div class="inner-box">
                <div class="image-box">
                    <figure class="image"><a href="{{ route('blog.show', ['category' => $blog->category, 'title_url' => $blog->title_url]) }}"><img src="{{ $blog->img_url }}" alt></a></figure>
                    <span class="date">
        {{ $blog->created_at->format('d') }} 
        <span class="month">{{ $blog->created_at->format('M') }}</span>
       
    </span>
                </div>
            <div class="lower-content">
                <ul class="post-info">
                    <li><i class="far fa-circle-user"></i> By {{ $blog->auth_name }}</li>
                    <li><i class="fa-sharp fal fa-comments fa-fw"></i> 2 Comments</li>
                </ul>
              <a href="{{ route('blog.show', ['category' => $blog->category, 'title_url' => $blog->title_url]) }}" class="blog-title">{{ $blog->title }}</a>



              
            </div>


         </div>
        </div>


        @endforeach

</div>
</div>
</section>



@endsection
