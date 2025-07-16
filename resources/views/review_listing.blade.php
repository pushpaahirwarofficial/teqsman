@extends('layouts.main')
@section('title', 'Review - TeqsMan')
@section('content')

<link rel="stylesheet" href="/public/css/bootstrap.min.css">
<link rel="stylesheet" href="/public/css/style.css">
<link rel="stylesheet" href="/public/css/responsive.css">
<!--<link rel="stylesheet" href="/public/css/font-awesome.min.css">-->
<link rel="stylesheet" href="/public/css/owl.carousel.min.css">
<link rel="stylesheet" href="/public/css/owl.theme.default.min.css">
<link rel="stylesheet" href="/public/css/colorbox.css">


<style>
        .truncate {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 4em; /* Approximate height for 2 lines */
        }
        .utf_post_thumb {
    max-width: 100%;
    position: relative;
    overflow: hidden;
    border-radius: 6px;
}
        
       .utf_post_block_style .utf_post_cat {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 1;
    border-radius: 4px;
}
        
    </style>

<section class="page-title" style="background-image: url(/public/assets/images/background/page-title.jpg);">
<div class="auto-container">
<div class="title-outer">
<h1 class="title">Review</h1>
<ul class="page-breadcrumb">
<li><a href="">Home</a></li>
<li>Review</li>
</ul>
</div>
</div>
</section>

<section class="utf_block_wrapper">
    <div class="container" style="padding-top: 20px;">
        <div class="row no-ads">
            <div class="col-lg-8 col-md-12">
                <div class="block category-listing category-style2">
                    <h3 class="utf_block_title"><span> Reviews</span></h3>
                   


                    @foreach ($reviews as $review)

                    <div class="utf_post_block_style post-list clearfix">
                        <div class="row no-ads">
                            <div class="col-lg-5 col-md-6" >
                                <div class="utf_post_thumb thumb-float-style"> <a href="#"> <img class="img-fluid" src="{{ $review->img_url }}" alt="" style="  width: 97%!important;height: 130px !important;" /> </a> <a class="utf_post_cat" href="#">{{ $review->category }}</a> </div>
                                </div>
                            <div class="col-lg-7 col-md-6">
                            <h2 class="utf_post_title title-large" >
<a href="{{ route('review.show', ['title_url' => $review->title_url]) }}/">{{ $review->title }}</a>
                            </h2>
                                 <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">{{ $review->auth_name }}</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i>{{$review->created_at->format('d M,Y')}}</span> <span class="post-comment pull-right"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>03</span></a></span> </div>
                                     <p class="truncate">{{ $review->description }}</p>
                                </div>
                            </div>
                        </div>
                 
                    @endforeach
                </div>
                
 
                                         
         




                </div>

        <div class="col-lg-4 col-md-12">
            <div class="sidebar utf_sidebar_right">
                <!--<div class="widget">-->
                <!--    <h3 class="utf_block_title"><span>Follow Us</span></h3>-->
                <!--    <ul class="social-icon">-->
                <!--    <li><a title="Facebook" href="https://www.facebook.com/itforsoftware/"><i class="fa fa-facebook"></i></a></li>-->
                <!--    <li><a title="Twitter" href="https://twitter.com/itforsoftware/"><i class="fa fa-twitter"></i></a></li>-->
                <!--    <li><a title="Linkdin" href="https://www.linkedin.com/company/itforsoftware/"><i class="fa fa-linkedin"></i></a></li>-->
                <!--    <li><a title="Pinterest" href="https://pinterest.com/itforsoftware/"><i class="fa fa-pinterest"></i></a></li>-->
                <!--    <li><a title="Instagram" href="https://www.instagram.com/itforsoftware/"><i class="fa fa-instagram"></i></a></li>-->
                <!--    </ul>-->
                <!--</div>-->

                

                <!--<div class="widget text-center">-->
                <!--      <a href="https://www.freelancerforseo.com/">-->
                <!--     <img class="banner img-fluid" src="/public/images/banner-ads/ad-sidebar.webp" alt="Ads Banner" /> -->
                <!--     </a>-->
                <!--     </div>-->
                <div class="widget m-bottom-0">
                    <h3 class="utf_block_title"><span>Newsletter</span></h3>
                    <div class="utf_newsletter_block">
                        <div class="utf_newsletter_introtext">
                            <h4>Stay updated!</h4>
                            <p>Subscribe to us to get informed with new exciting tips, and exclusive tech knowledge.</p>
                        </div>
                        <div class="utf_newsletter_form">
                        <form action="" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" id="utf_newsletter_form-email" class="form-control form-control-lg" placeholder="E-Mail Address" autocomplete="off">
                                    <button class="btn btn-primary">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
</section>
<script>
    $(document).ready(function() {
    $('#rating').starRating({
        starSize: 25,
        callback: function(currentRating, $el){
            $('#rating-value').val(currentRating); // Set the value of the hidden input to the selected rating
        }
    });
});

</script>

@endsection
