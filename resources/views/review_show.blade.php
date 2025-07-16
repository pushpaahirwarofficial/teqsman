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
.solid {
    color: #ff9415 !important;

}
.icon_star_alt:before {
	content: "\e031";
}
.icon_star-half_alt:before {
	content: "\e032";
}
.icon_star:before {
	content: "\e033";
}
.icon_star-half:before {
	content: "\e034";
}
.icon_star_alt, .icon_star-half_alt, .icon_star, .icon_star-half {
	font-family: 'ElegantIcons';
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing: antialiased;
}
.no-ads .google-auto-placed {
   display: none !important;
}

.comments-list .comment-body {
    margin-left: 0px;
}
</style>


<section class="utf_block_wrapper">
    
    
  <div class="container" style="padding-top: 0px;">
    <div class="row no-ads">
      <div class="col-lg-8 col-md-12">
          <div class="mb-2" style="background: aliceblue; padding:10px; width:98%;">
              <div class="utf_post_title-area mb-2" style="width:100%;"> 
              <a class="utf_post_cat" href="#">{{ $review->category }}</a>
                  <h1 class="text-center">{{ $review->title }}</h1>
                      <!-- Ratings -->
                        <div class="back-ratings mb-3 text-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $average_rating)
                                    <i class="fa fa-star solid"></i>
                                @else
                                    <i class="fa fa-star"></i>
                                @endif
                            @endfor
                        </div>
                </div>
           
         
            
                  <p style="width:100%; font-size:16px;">{{ $review->description }}</p>
                  
             </div>
                 <div class="post-media post-featured-image">
                      
                    <img src="{{ $review->img_url }}" class="img-fluid" alt="" style="width:98%; height:300px;">
            </div>
           
          <div class="utf_post_content-area">
            <div class="entry-content" style="width:100%;">
              {!! $review->body !!}

            </div>

            <div class="tags-area clearfix">
              <div class="post-tags">
                <span>Category:</span>
                <a href="#"> Streaming</a>
                <a href="#"> Work</a>
                <a href="#"> Refund</a>
                <a href="#"> Fitness</a>
              </div>
            </div>





            <div class="share-items clearfix custom-width" style="width:87%";>
              <ul class="post-social-icons unstyled">
                <li class="facebook"> <a href="https://www.facebook.com/teqsman"> <i class="fa fa-facebook"></i> <span class="ts-social-title">Facebook</span></a> </li>
                <li class="twitter"> <a href="https://twitter.com/teqsman"> <i class="fa fa-twitter"></i> <span class="ts-social-title">Twitter</span></a> </li>
                <li class="gplus"> <a href="https://www.instagram.com/teqsman/"> <i class="fa fa-instagram"></i> <span class="ts-social-title">Instagram</span></a> </li>
                <li class="" style="background-color:#0077b7;"> <a href="https://www.linkedin.com/company/teqsman/"> <i class="fa fa-linkedin"></i> <span class="ts-social-title">Linkedin</span></a> </li>
                <li class="pinterest"> <a href="https://in.pinterest.com/teqsman/"> <i class="fa fa-pinterest"></i> <span class="ts-social-title">Pinterest</span></a> </li>
              </ul>
        </div>
          </div>
          
          <!--comment-->
          
           <div id="comments" class="comments-area block">
                  <h3 class="utf_block_title"><span>{{ $review_comments->count() }} Review</span></h3>
                  <ul class="comments-list">
                 @foreach($review_comments as $review_comment)
            <li>
              <div class="comment">
                <!-- Replace the img src with the actual avatar image of the commenter -->
                <!--<img class="comment-avatar pull-left" alt="" src="{{ asset('public/images/news/user1.png') }}">-->
                <div class="comment-body">
                  <div class="meta-data">
                    <span class="comment-author">{{ $review_comment->name }}</span>
                    <span class="comment-date pull-right">{{ $review_comment->created_at->format('d M, Y') }}</span>
                  </div>
                  <div>
                       <div>
                               
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review_comment->ratings)
                                        <i class="fa fa-star solid"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                @endfor
                    </div>
                  </div>
                  <div class="comment-content">
                    <p>{{ $review_comment->comment }}</p>
                  </div>
                 
                </div>
              </div>
              </li>
              @endforeach
              </ul>
          </div>
          
            <div class="comments-form">
                  <h3 class="title-normal">Write a Review</h3>
                  <form method="post" action="/review/commentstore">
                    @csrf <!-- CSRF Token -->
                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                     <!-- Ratings -->
                       <div class="mb-4">
                            <div class="back-ratings mb-3 ml-3"> <b>Ratings:</b>
                            <i class="fa fa-star solid" onclick="ratingStarFun('star1')" id="star1"></i>
                            <i class="fa fa-star solid" onclick="ratingStarFun('star2')" id="star2"></i>
                            <i class="fa fa-star solid" onclick="ratingStarFun('star3')" id="star3"></i>
                            <i class="fa fa-star solid" onclick="ratingStarFun('star4')" id="star4"></i>
                            <i class="fa fa-star solid" onclick="ratingStarFun('star5')" id="star5"></i>
                        </div>
                       </div>
                        <input type="hidden" name="rating_number" value="5" id="rating_number">
                      
                     
                    <div class="row">
                        
                      <div class="col-md-6">
                        <div class="form-group">
                          <input class="form-control" name="name" id="name" placeholder="Name" type="text" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input class="form-control" name="email" id="email" placeholder="Email" type="email" required>
                        </div>
                      </div>
                      
                       <div class="col-md-12">
                        <div class="form-group">
                          <textarea class="form-control required-field" name="comment" id="comment" placeholder="review" rows="10" required></textarea>
                        </div>
                      </div>
                     
                      
                    </div>
                    </div>
                    <div class="clearfix">
                      <button class="comments-btn btn btn-primary" type="submit">Post Review</button>
                    </div>
                  </form>
           </div>
         

           
     <div class="col-lg-4 col-md-12">
        <div class="sidebar utf_sidebar_right">
          <div class="widget">
            <h3 class="utf_block_title"><span>Follow Us</span></h3>
            <ul class="social-icon">
            <li><a target="_blank" title="Facebook" href="https://www.facebook.com/teqsman"><i class="fa fa-facebook"></i></a></li>
            <li><a target="_blank" title="Twitter" href="https://twitter.com/teqsman"><i class="fa fa-twitter"></i></a></li>
            <li><a target="_blank" title="Linkdin" href="https://www.linkedin.com/company/teqsman/"><i class="fa fa-linkedin"></i></a></li>
            <li><a target="_blank" title="Pinterest" href="https://in.pinterest.com/teqsman/"><i class="fa fa-pinterest"></i></a></li>
            <li><a target="_blank" title="Instagram" href="https://www.instagram.com/teqsman/"><i class="fa fa-instagram"></i></a></li>
           
            </ul>
          </div>

         
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function ratingStarFun(star_id) {
    if (star_id == "star1") {
        $(`#star1`).addClass('solid');
        $(`#star2`).removeClass('solid');
        $(`#star3`).removeClass('solid');
        $(`#star4`).removeClass('solid');
        $(`#star5`).removeClass('solid');
        $(`#rating_number`).val(1);

    } else if (star_id == "star2") {
        $(`#star1`).addClass('solid');
        $(`#star2`).addClass('solid');
        $(`#star3`).removeClass('solid');
        $(`#star4`).removeClass('solid');
        $(`#star5`).removeClass('solid');
        $(`#rating_number`).val(2);
    } else if (star_id == "star3") {
        $(`#star1`).addClass('solid');
        $(`#star2`).addClass('solid');
        $(`#star3`).addClass('solid');
        $(`#star4`).removeClass('solid');
        $(`#star5`).removeClass('solid');
        $(`#rating_number`).val(3);
    } else if (star_id == "star4") {
        $(`#star1`).addClass('solid');
        $(`#star2`).addClass('solid');
        $(`#star3`).addClass('solid');
        $(`#star4`).addClass('solid');
        $(`#star5`).removeClass('solid');
        $(`#rating_number`).val(4);
    } else if (star_id == "star5") {
        $(`#star1`).addClass('solid');
        $(`#star2`).addClass('solid');
        $(`#star3`).addClass('solid');
        $(`#star4`).addClass('solid');
        $(`#star5`).addClass('solid');
        $(`#rating_number`).val(5);
    }
}
</script>

@endsection
