

<style>
    .lnews-widget .post-right {
     padding-left: 0px!important; 
}
</style>

<footer class="main-footer">
<div class="bg footer-bg"></div>

<div class="widgets-section">
<div class="auto-container">
<div class="row">

<div class="footer-column col-sm-6 col-lg-3">
    <h4 class="widget-title">TeqsMan</h4>

<div class="footer-widget about-widget">
<div class="text">TeqsMan offers expert repairs for appliances, ACs, and software. Trust TeqsMan for top-quality service!</div>
<ul class="list-style-two">
<li><a href="tel:+1234567890"><i class="fa-regular fa-phone-volume fa-fw"></i> +1(888) 816-8628</a></li>
<li> <a href="mailto:info@teqsman.com"><i class="fal fa-envelope"></i> <span class="__cf_email__">info@teqsman.com</span></a></li>
</ul>
<ul class="social-icon-two">
<li><a href="https://twitter.com/teqsman"><i class="fab fa-twitter"></i></a></li>
<li><a href="https://www.facebook.com/teqsman/"><i class="fab fa-facebook"></i></a></li>
<li><a href="https://www.instagram.com/teqsmann/"><i class="fab fa-instagram"></i></a></li>
<li><a href="https://www.pinterest.com/teqsman/"><span class="fab fa-pinterest"></span></a></li>
</ul>
</div>
</div>

<div class="footer-column col-sm-6 col-lg-3">
<div class="footer-widget about-widget">
<h4 class="widget-title">Links</h4>
<ul class="user-links">
<li><a href="#">AC Maintenance</a></li>
<li><a href="#">Dust Cleaning</a></li>
<li><a href="#">Heating Services</a></li>
<li><a href="#">HVAC Installation</a></li>
<li><a href="#">Heating and Water</a></li>
</ul>
</div>
</div>

<div class="footer-column col-sm-6 col-lg-3 ps-xl-0">
<div class="footer-widget lnews-widget">
<h4 class="widget-title">Latest News</h4>
<div class="widget-content">
<div class="post-item">

<ul class="post-right">
<li class="d-flex align-items-center posted-date mb-2">
<i class="far fa-calendar-days me-2"></i>
<a class="entry-date" href>17 Sep,2024</a>
</li>
<li class="title-holder">
<h6 class="entry-title">
<a href>Printer repair service</a>
</h6>
</li>
</ul>
</div>
<div class="post-item">

<ul class="post-right">
<li class="d-flex align-items-center posted-date mb-2">
<i class="far fa-calendar-days me-2"></i>
<a class="entry-date" href>17 Sep,2024</a>
</li>
<li class="title-holder">
<h6 class="entry-title">
<a href>AC Servicing</a>
</h6>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="footer-column col-sm-6 col-lg-3">
<div class="footer-widget gallery-widget">
<h4 class="widget-title">Instagram</h4>
<div class="outer clearfix">
<figure class="image"><a href="#"><img src="/public/assets/images/resource/insta-thumb-1.jpg" alt></a></figure>
<figure class="image"><a href="#"><img src="/public/assets/images/resource/insta-thumb-2.jpg" alt></a></figure>
<figure class="image"><a href="#"><img src="/public/assets/images/resource/insta-thumb-3.jpg" alt></a></figure>
<figure class="image"><a href="#"><img src="/public/assets/images/resource/insta-thumb-4.jpg" alt></a></figure>
<figure class="image"><a href="#"><img src="/public/assets/images/resource/insta-thumb-5.jpg" alt></a></figure>
<figure class="image"><a href="#"><img src="/public/assets/images/resource/insta-thumb-6.jpg" alt></a></figure>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="footer-bottom">
<div class="auto-container">
<div class="inner-container">
<div class="copyright-text">&copy; Copyright reserved by <a href="/">teqsman.com</a> Developed by <a href="https://www.webreakglobal.com/">WeBreak Global</a></div>
</div>
</div>
</div>
</footer>

</div>

<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

<script src="/public/assets/js/popper.min.js"></script>
<script src="/public/assets/js/bootstrap.min.js"></script>
<script src="/public/assets/js/jquery.fancybox.js"></script>
<script src="/public/assets/js/jquery-ui.js"></script>
<script src="/public/assets/js/wow.js"></script>
<script src="/public/assets/js/appear.js"></script>
<script src="/public/assets/js/select2.min.js"></script>
<script src="/public/assets/js/swiper.min.js"></script>
<script src="/public/assets/js/owl.js"></script>
<script src="/public/assets/js/script.js"></script>

<script src="/public/assets/js/jquery.validate.min.js"></script>
<script src="/public/assets/js/jquery.form.min.js"></script>
<script>
  (function ($) {
    $("#contact_form").validate({
      submitHandler: function (form) {
        var form_btn = $(form).find('button[type="submit"]');
        var form_result_div = "#form-result";
        $(form_result_div).remove();
        form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
        var form_btn_old_msg = form_btn.html();
        form_btn.html(form_btn.prop("disabled", true).data("loading-text"));
        $(form).ajaxSubmit({
          dataType: "json",
          success: function (data) {
            if (data.status == "true") {
              $(form).find(".form-control").val("");
            }
            form_btn.prop("disabled", false).html(form_btn_old_msg);
            $(form_result_div).html(data.message).fadeIn("slow");
            setTimeout(function () {
              $(form_result_div).fadeOut("slow");
            }, 6000);
          },
        });
      },
    });
  })(jQuery);
</script>