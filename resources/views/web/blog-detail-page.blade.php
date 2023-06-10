@include('web.web-header')
<style>
#mid_text-detail{
	position: absolute;
    color: #fff;
    margin: 0 auto;
    padding: 20% 7%;
    text-align: center;
    top: 100px;
    width: 100%;
}
.blogimg-div{
	position: -webkit-sticky;
  	position: sticky;
  	top: 0;
  	background-color: yellow;
  	padding: 0px;
  	font-size: 0px;
}
	@media screen and (min-width: 0px) and (max-width: 575px) {
		div#mid_text-detail {
			position: absolute !important;
			top: 8% !important;
			left: 0% !important;
		}
		.blogimg-div img{
			height: 16rem !important;
    		width: 100%;
		}
		.fs-sm-36{
			font-size: 40px !important;
		}
    }


</style>
<main id="content">

<section class="pt-5 pb-6 mt-0 mt-md-5 mt-sm-0 mt-xl-5 mt-xxl-5">
	<div class="container container-custom container-xl">
		<div class="row">

			<div class="col-lg-6 position_inc_blog_detail ">
			<div class="blogimg-div">
				<?php if(isset($blogDetail['detailImage']) && $blogDetail['detailImage'] != ''){?>
					<img src="<?php echo $blogDetail['detailImage'];?>" alt="img" style="height: 33rem;width: 100%;">
				<?php }?>
				<div class="mid_text_blog_detail" id="mid_text-detail">
					<h2 class="text-capitalize text-center mb-0">
						<?php echo isset($blogDetail['TITLE']) ? $blogDetail['TITLE'] : '';?>
					</h2>
					<div class="text-center pt-4">
						<p><?php echo isset($blogDetail['DATE']) ? $blogDetail['DATE'] : '';?></p>
					</div>
				</div>
			</div>



			</div>
			<div class="col-lg-6 mob_inc_blog_detail ">
			<h2 class="text-capitalize mb-0">
				<?php echo isset($blogDetail['TITLE']) ? $blogDetail['TITLE'] : '';?>
			</h2>
			<?php echo isset($blogDetail['DESCRIPTION']) ? $blogDetail['DESCRIPTION'] : '';?>
			</div>
		</div>
	</div>
</section>
</main>

@include('web.web-footer')

<script>
	 function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top','77px');
    }
  jQuery(document).ready(function () {


//   jQuery(window).scroll(function () {
//     if (jQuery(window).scrollTop() >= 20 && jQuery(window).scrollTop() <= 750){
//       jQuery("#mid_text-detail").css({position: 'fixed', top: '100px'});
//       jQuery("#mid_text-detail").css({width: '50%', top: '100px'});
//     } else {
//       jQuery("#mid_text-detail").css({position: 'static', top: '0px'});
//     }
//   });

});
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
