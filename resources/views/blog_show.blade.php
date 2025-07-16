@extends('layouts.main')
@section('title', 'Blog- Detail')


@section('pagetitle') 
    {{ $blog->meta_title ?? 'Default Title' }} 
@endsection

@section('keywords') 
    {{ $blog->meta_key ?? 'Default Keywords' }} 
@endsection

@section('description') 
    {{ $blog->meta_desc ?? 'Default Description' }} 
@endsection


@section('content')

<style>
    .blog-details__img img {
    border-radius: 10px;
    width: 100%;
    height: 350px!important;
}

.nav-links>div>a {
    padding: 5px 23px!important;
}
h1, h2, h3, h4, h5, h6 {
    margin-top: 19px!important;
}

h1, h2, h3, h4, h5, h6 {
    margin-bottom: 0px!important;
}
</style>


<!--<section class="page-title" style="background-image: url(/public/assets/images/background/page-title.jpg);">-->
<!--<div class="auto-container">-->
<!--<div class="title-outer">-->
<!--<h1 class="title">Blog Details</h1>-->
<!--<ul class="page-breadcrumb">-->
<!--<li><a href="/">Home</a></li>-->
<!--<li>Blog</li>-->
<!--</ul>-->
<!--</div>-->
<!--</div>-->
<!--</section>-->


<section class="blog-details">
<div class="container">
<div class="row">
<div class="col-xl-8 col-lg-7">
<div class="blog-details__left">
<div class="blog-details__img">

<img src="{{ $blog->img_url }}" alt>

<!--<div class="blog-details__date">-->
<!--<span class="day"></span>-->
<!--<span class="month"></span>-->
<!--</div>-->
</div>

<div class="blog-details__content">
<ul class="list-unstyled blog-details__meta">
<li><a href=""><i class="fas fa-user-circle"></i> {{ $blog->auth_name }}</a> </li>
<li><a href=""><i class="fas fa-comments"></i>{{$blog->created_at->format('d M,Y')}}</a>
</li>
</ul>
<h3 class="blog-details__title">{{ $blog->title }}</h3>
<p class="blog-details__text-2">  {!! $blog->body !!}
</p>
</div>


<!--<div class="blog-details__bottom">-->
<!--<p class="blog-details__tags"> <span>Tags</span> <a href="#" style="text-decoration:none;">Servicing</a> <a href="#" style="text-decoration:none;">AC</a> </p>-->
<!--<div class="blog-details__social-list"> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-pinterest-p"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> </div>-->
<!--</div>-->
<div class="nav-links">
<div class="prev">
<a href="#" rel="prev" style="font-size:15px;">AC flow through better supply in UK</a>
</div>
<div class="next">
<a href="#" rel="next"  style="font-size:15px;">Why is supply chain visibility so important?</a>
</div>
</div>

</div>
</div>
<div class="col-xl-4 col-lg-5">
<div class="sidebar">
<div class="sidebar__single sidebar__search">
<form action="#" class="sidebar__search-form">
<input type="search" placeholder="Search here">
<button type="submit"><i class="lnr-icon-search"></i></button>
</form>
</div>
<div class="sidebar__single sidebar__post">
<h3 class="sidebar__title">Latest Posts</h3>
 @foreach($popularSection as $popularStream)
<ul class="sidebar__post-list list-unstyled">
    <li>
        <div class="sidebar__post-image"> 
            <img src="{{ $popularStream->img_url }}" alt> 
        </div>
        <div class="sidebar__post-content">
            <h3>
                <span class="sidebar__post-content-meta">
                    <i class="fas fa-user-circle"></i>{{ $popularStream->auth_name }}
                </span> 
                <a href="{{ route('blog.show', ['category' => $popularStream->category, 'title_url' => $popularStream->title_url]) }}">
                    {{ $popularStream->title }}
                </a>
            </h3>
        </div>
    </li>
</ul>
@endforeach


</div>
<div class="sidebar__single sidebar__category">
<h3 class="sidebar__title">Categories</h3>
<ul class="sidebar__category-list list-unstyled">
<li><a href="#">HVAC<span class="icon-right-arrow"></span></a> </li>
<li class="active"><a href="#">Installation<span class="icon-right-arrow"></span></a></li>
<li><a href="#">Repairing<span class="icon-right-arrow"></span></a> </li>
<li><a href="#">Air Quality<span class="icon-right-arrow"></span></a> </li>
<li><a href="#">Thermal<span class="icon-right-arrow"></span></a> </li>
<li><a href="#">Checkup<span class="icon-right-arrow"></span></a> </li>
</ul>
</div>
<!--<div class="sidebar__single sidebar__tags">-->
<!--<h3 class="sidebar__title">Tags</h3>-->
<!--<div class="sidebar__tags-list"> <a href="#">Business</a> <a href="#">HVAC</a> <a href="#">Checkup</a> <a href="#">Servicing</a> <a href="#">Repairing</a> <a href="#">Trends</a> </div>-->
<!--</div>-->
<!--</div>-->
</div>
</div>
</div>
</section>



@endsection
