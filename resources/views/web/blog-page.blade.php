@include('web.web-header')
<style>
    /* Add this style in your CSS file or inside the <style> tag of your HTML */


	.blogdo{
		position: sticky;
		top: 10px;
	}

    .mid_text_blog{
        position: absolute;
        top: 300px;
        width: 100%;
    }
	@media screen and (min-width: 0px) and (max-width: 575px) {

		.fs-sm-40{
			font-size: 40px !important;
		}
		div#mid_text {
			position: absolute !important;
			top: 42% !important;
			left: 0% !important;
		}
    }

    .blogdo {
        /* position: relative; */
    }

    .blogdo .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* You can adjust the transparency by changing the last value (0.6 in this case) */
        z-index: 1; /* Make sure the overlay is above the image */
    }

    .mid_text_blog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 100%;
        z-index: 2; /* Make sure the text is above the overlay */
    }

    /* Add any additional styles for the text or adjust existing styles as needed */
    .mid_text_blog h2 {
        font-size: 2rem;
        font-weight: bold;
    }


      /* Add this style in your CSS file or inside the <style> tag of your HTML */
        .sing_blog {
        position: relative;
    }

    .sing_blog .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* You can adjust the transparency by changing the last value (0.6 in this case) */
    }

    /* Add any additional styles for the text or adjust existing styles as needed */
    .sing_blog h2 p,
    .sing_blog p {
        position: relative;
        z-index: 1; /* Make sure the text is above the overlay */
    }
</style>
<main id="content">
  	<section class="pt-5 pb-6 mt-0 mt-md-5 mt-sm-0 mt-xl-0 mt-xxl-5">
     	<div class="row">

      		@if(isset($ourblog) && !empty($ourblog))
      		{{-- <div class="col-lg-6 position_inc_blog_detail">
	           	<div class="blogdo">
                    <div class="overlay"></div>
	           		<img src="{{$ourblog['image']}}" alt="img" style="height: 55rem;width:100%;">

		        	<div class="mid_text_blog" id="mid_text">
						<h2 class="text-center text-white mb-0">{{ $ourblog['NAME']}}</h2>
		        	</div>
	           	</div>
	        </div> --}}
            <div class="col-lg-6 position_inc_blog_detail">
                <div class="blogdo">
                    <img src="{{$ourblog['image']}}" alt="img" style="height: 55rem; width: 100%;">
                    <div class="overlay"></div> <!-- Move the overlay after the image -->
                    <div class="mid_text_blog" id="mid_text">
                        <h2 class="text-center text-white mb-0">{{ $ourblog['NAME']}}</h2>
                    </div>
                </div>
            </div>


	         @endif

	         <div class="col-lg-6">
	         	@if(isset($blogs) && !empty($blogs))
	         	@foreach($blogs as $blog)
				{{-- <a href="{{session('site')}}/blog-detail/{{$blog['BLOG_ID']}}">
					<div class="sing_blog" style="background-image: url({{$blog['image']}}); background-size: cover; padding: 50px;">
						<h2 class="text-capitalize mb-0" style="color:#fff;">
							<p style="color:#fff;">{{ \Illuminate\Support\Str::limit($blog["TITLE"], 25, $end='...')}}</p>
						</h2>
						<p style="color:#fff;HEIGHT: 73PX;">{{$blog["DESCRIPTION_TEXT"]}}</p>
					</div>
				</a> --}}
                <a href="{{session('site')}}/blog-detail/{{$blog['SLUG']}}">
                    <div class="sing_blog" style="background-image: url({{$blog['image']}}); background-size: cover; padding: 50px;">
                        <div class="overlay"></div> <!-- Add the overlay div here -->
                        <h2 class="text-capitalize mb-0" style="color:#fff;">
                            <p style="color:#fff;">{{ \Illuminate\Support\Str::limit($blog["TITLE"], 25, $end='...')}}</p>
                        </h2>
                        <p style="color:#fff; HEIGHT: 73PX;">{{$blog["DESCRIPTION_TEXT"]}}</p>
                    </div>
                </a>

	            @endforeach
	           	@endif
				<!-- <div class="sing_blog" style="background-image: url({{ url('/assets-web') }}/images/blogging-2.webp); background-size: cover; padding: 50px;">
					<h2 class="fs-24 fs-sm-36 mb-0" style="color:#fff;">
						<a href="blog-detail-page.html" style="color:#fff;">Your 2022 Skin Reset</a>
					</h2>
					<p style="color:#fff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
	            </div>

				<div class="sing_blog" style="background-image: url({{ url('/assets-web') }}/images/blogging-1.webp); background-size: cover; padding: 50px;">
					<h2 class="fs-24 fs-sm-36 mb-0" style="color:#fff;">
						<a href="blog-detail-page.html" style="color:#fff;">Our 5 Signature Ingredients</a>
					</h2>
					<p style="color:#fff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
	            </div>

				<div class="sing_blog" style="background-image: url({{ url('/assets-web') }}/images/blogging-2.webp); background-size: cover; padding: 50px;">
					<h2 class="fs-24 fs-sm-36 mb-0" style="color:#fff;">
						<a href="blog-detail-page.html" style="color:#fff;">Your 2022 Skin</a>
					</h2>
					<p style="color:#fff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
	            </div>


				<div class="sing_blog" style="background-image: url({{ url('/assets-web') }}/images/blogging-1.webp); background-size: cover; padding: 50px;">
					<h2 class="fs-24 fs-sm-36 mb-0" style="color:#fff;">
						<a href="blog-detail-page.html" style="color:#fff;">Our 5 Signature Ingredients</a>
					</h2>
					<p style="color:#fff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
				</div> -->


			</div>

     	</div>
     </section>
</main>

@include('web.web-footer')

<script>
  jQuery(document).ready(function () {


  jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() >= 20 && jQuery(window).scrollTop() <= 750){
      jQuery("#mid_text-detail").css({position: 'fixed', top: '100px'});
      jQuery("#mid_text-detail").css({width: '50%', top: '100px'});
    } else {
      jQuery("#mid_text-detail").css({position: 'static', top: '0px'});
    }
  });

});
function close_topbar(){
            $("#topbar").removeClass('d-xl-flex');
            $("#content").css('padding-top','77px');

        }
// window.onscroll = function() {myFunction()};

//          var header = document.getElementById("mid_text-detail");
//          var btm = document.getElementById("mycontent");
//          var sticky = header.offsetTop;
//         var bottom = btm.offsetTop;

//          function myFunction() {
//           if (window.pageYOffset > 30) {
//              header.style.position = "fixed";
//              header.style.top = "0";

//           } else {
//              header.style.position = "unset";
//           }
//           if (window.pageYOffset > (bottom -500))
//       {
//             header.style.position = "unset";
//           }



//          }
</script>
