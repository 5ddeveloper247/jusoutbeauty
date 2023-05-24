<!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &#169; Designed &amp; Developed by <a href="#" target="_blank">5D Solutions</a> 2020</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->    
    
<!-- Required vendors -->
    <script src="{{ url('/assets-admin') }}/third_party/admin/global/global.min.js"></script>
	<script src="{{ url('/assets-admin') }}/third_party/admin/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{ url('/assets-admin') }}/third_party/admin/chart.js/Chart.bundle.min.js"></script>
	<script src="{{ url('/assets-admin') }}/third_party/admin/owl-carousel/owl.carousel.js"></script>
	
    <script src="{{ url('/assets-admin') }}/third_party/admin/moment/moment.min.js"></script>
	<!-- Date Range -->
	
    <script src="{{ url('/assets-admin') }}/third_party/admin/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- Chart piety plugin files -->
    <script src="{{ url('/assets-admin') }}/third_party/admin/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="{{ url('/assets-admin') }}/third_party/admin/apexchart/apexchart.js"></script>
	
    
	<!-- Dashboard 1 -->
	<script src="{{ url('/assets-admin') }}/js/admin/dashboard/dashboard-1.js"></script>
	<!-- Datatables -->
    <script src="{{ url('/assets-admin') }}/third_party/admin/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/assets-admin') }}/js/admin/plugins-init/datatables.init.js"></script>
    
    <!-- Summernote -->
    <script src="{{ url('/assets-admin') }}/third_party/admin/summernote/js/summernote.min.js"></script>
    <!-- Summernote init -->
    <script src="{{ url('/assets-admin') }}/js/admin/plugins-init/summernote-init.js"></script>
    
    <!-- Dropezone -->
    <script src="{{ url('/assets-admin') }}/third_party/admin/dropzone/dist/dropzone.js"></script>
    
    <!-- Select2 -->
    
	<script src="{{ url('/assets-admin') }}/third_party/admin/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ url('/assets-admin') }}/third_party/admin/select2/js/select2.full.min.js"></script>
    <script src="{{ url('/assets-admin') }}/js/admin/plugins-init/select2-init.js"></script>
    
    
    <script src="{{ url('/assets-admin') }}/js/admin/custom.min.js"></script>
	<script src="{{ url('/assets-admin') }}/js/admin/deznav-init.js"></script>
	
	<!-- angular files -->
	<script src="{{ url('/public') }}/third_party/angular/angular.min.js"></script>
	<script src="{{ url('/public') }}/third_party/angular/drag.js"></script>
	<script src="{{ url('/public') }}/third_party/angular/smart.js"></script>
	
	<!--  toastr and loading overlay -->
	<script src="{{ url('/public') }}/third_party/jquery-loading-overlay/src/loadingoverlay.js"></script>
	<script src="{{ url('/public') }}/third_party/toastr/js/toastr.min.js"></script>
	
	<!-- jquery file upload plugin  -->
	<script src="{{ url('/public') }}/third_party/file-upload/js/vendor/jquery.ui.widget.js"></script>
	<script src="{{ url('/public') }}/third_party/file-upload/js/jquery.fileupload.js"></script>
		
	
    <script>

		toastr.options = {
			timeOut : 0,
			extendedTimeOut : 100,
			tapToDismiss : true,
			debug : false,
			fadeOut: 10,
			positionClass : "toast-top-center"
		};
	
	</script>
	<script>
		function carouselReview(){
			/*  testimonial one function by = owl.carousel.js */
			function checkDirection() {
				var htmlClassName = document.getElementsByTagName('html')[0].getAttribute('class');
				if(htmlClassName == 'rtl') {
					return true;
				} else {
					return false;
				
				}
			}
			
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:30,
				nav:false,
				dots: false,
				rtl: checkDirection(),
				left:true,
				navText: ['', ''],
				responsive:{
					0:{
						items:1
					},			
					1200:{
						items:2
					},
					1600:{
						items:3
					}
				}
			})			
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});
	</script>    <script type="text/javascript">
       
    </script>
</body>

</html>