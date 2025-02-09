@include('web.web-header')
<style>

    /* Add this style in your CSS file or inside the <style> tag of your HTML */
        .rab {
        position: relative;
    }

    .rab .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Adjust the transparency (0.5 in this case) */
     /* Place the overlay behind the content */
    }

    /* Add any additional styles for the text or adjust existing styles as needed */
    .rab .data {
        position: relative;
        z-index: 2; /* Set text color to white to make it visible on the dark overlay */
    }
    @media only screen and (max-width: 320px) {
        .bg-img-cover-center {
    width: 320px !important;
}

    }

    @media only screen and (max-width: 480px) {

        .bg-img-cover-center {
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
            width: 374px;
            height: auto;
        }
        .text-black{
            color: #d8d8d8
        }
        .take-selfi-quiz{
            font-size: 14px !important;
        }
        .selfi{
            padding: 4px 9px;
        }
        .quiz-text{
            font-size: 11px;
        }
    }
</style>
<main id="content">
    {{-- <section class="header_user_shade_finder">
        <div class="container container-xxl mt-5">
            <h2 class=" text-center" data-animate="fadeInUp">Let's Find Your Shade</h2>
            <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Modi harum quidem voluptate aliquam quod itaque velit eius vero doloribus ad.</p>
        </div>
    </section> --}}
    {{-- <section class="py-lg-10  py-3 bg-img-cover-center" id="details-header"
        style="background-image: url('{{ url('/assets-web') }}/images/shadeimg.webp');background-color: #F2F2F2">
        <div class="container container-xxl">
            <div class="container container-xxl">
                <h2 class=" text-center" data-animate="fadeInUp">Let's Find Your Shade</h2>
                <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Modi harum quidem voluptate aliquam quod itaque velit eius vero doloribus ad.</p>
            </div>
            <p class="text-primary fs-18 font-weight-600 mb-4 lh-1444" data-animate="fadeInUp"></p>
            <div>
                <h2 class="mb-2 take-selfi-quiz">Take A Quiz</h2>
                <p class="text-black quiz-text">One of our pro makeup artists will <br>personally provide shade recommendations.
                </p>
                <div class="">
                    <a href="usershadefinderquiz" class="btn btn-primary selfi">Take A Quiz</a>
                </div>
            </div>
            <br>
            <div>
                <h2 class="mb-2 take-selfi-quiz">Send Us a Selfie</h2>

                <div class="">
                    <a href="#" class="btn btn-primary selfi" id="selfie-btn-shade">Snap A Selfie</a>
                </div>
            </div>
        </div>
    </section> --}}
                <section class="py-lg-10 py-3 bg-img-cover-center rab" id="details-header"
                style="background-image: url('{{ url('/assets-web') }}/images/shadeimg.webp'); background-color: #F2F2F2">
                <div class="overlay"></div>
                <div class="container container-xxl data">
                    <div class="container container-xxl">
                        <h2 class="text-center text-white" data-animate="fadeInUp">Let's Find Your Shade</h2>
                        <p class="text-center text-white">Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Modi harum quidem
                            voluptate aliquam quod itaque velit eius vero doloribus ad.</p>
                    </div>
                    <p class="text-primary fs-18 font-weight-600 mb-4 lh-1444" data-animate="fadeInUp"></p>
                    <div>
                        <h2 class="mb-2 take-selfi-quiz text-white">Take A Quiz</h2>
                        <p class="text-black quiz-text text-white">One of our pro makeup artists will <br>personally provide shade
                            recommendations.</p>
                        <div class="">
                            <a href="usershadefinderquiz" class="btn btn-primary selfi ">Take A Quiz</a>
                        </div>
                    </div>
                    <br>
                    <div>
                        <h2 class="mb-2 take-selfi-quiz text-white">Send Us a Selfie</h2>
                        <div class="">
                            <a href="#" class="btn btn-primary selfi " id="selfie-btn-shade">Snap A Selfie</a>
                        </div>
                    </div>
                </div>
            </section>


    <section class="pt-10 pt-lg-13 mb-10" id="snap-selfie" style="display:none;">
        <div class="container">
            <div class="text-center mw-500 mx-auto">
                <img src="images/icon-home-09.png" alt="">
                <h2 class="text-center text-capitalize mb-3">
                    Snap a Selfie
                </h2>
                <p>Follow these instructions to get an accurate representation of your skin on camera.
                    Turn your face toward the daylight (It is the most honest between 11am or 2pm). Stand near a window
                    or well lit vanity. Avoid harsh overhead lighting.</p>
                <form action="{{ route('saveSelfie') }}" method="POST" id="saveSelfie">
                    <label style=" display: block !important;text-align:left;">Enter your name</label>
                    <input type="text" id="name" name="name" class="form-control mb-3" placeholder="Name"
                        required>
                    <label style=" display: block;text-align:left;">Enter your email</label>
                    <input name="email" type="email" id="email" name="email" class="form-control mb-3"
                        placeholder="Email" required>
                    <label style=" display: block;text-align:left;">Upload your selfie</label>
                    <input name="file" type="file" class="form-control mb-3 @error('file')
                        is-invalid
                    @enderror" placeholder="UPLOAD YOUR SELFIE"
                        id="selfie_img" name="selfie_img" required accept="images/*">
                    @error('file')
                        {{ $message }}
                    @enderror

                    <button type="submit" class="btn btn-primary btn-block savebtn">Submit</button>
                    <button type="button" class="btn btn-primary btn-block loaderbtn" disabled style="display: none"><i
                            class="ft-rotate-cw spinner"></i> Processing</button>

                </form>
            </div>
        </div>
    </section>
</main>
@include('web.web-footer')

<script>
    $("#selfie-btn-shade").click(function() {
        $("#snap-selfie").css("display", "block");
        $('html, body').animate({
            scrollTop: $("#snap-selfie").offset().top
        }, 2000);
    });
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
    });

    $("#saveSelfie").submit(function(e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            async: true,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(data) {
                $('.loaderbtn').show();
                $('.savebtn').hide();
            },
            success: function(data) {

                if (data.done == true || data.done == 'true') {
                    console.log(data);
                    toastr.success(data.msg, '', {
                        timeOut: 3000
                    })
                    $("#snap-selfie").css("display", "none");
                    $("#saveSelfie").trigger('reset');
                    $('html, body').animate({
                        scrollTop: $("#snap-selfie").offset().top
                    }, 2000);
                }else
                if(data.done == false || data.done == 'false'){
                    toastr.error(data.msg, '', {
                        timeOut: 3000
                    })
                }
            },
            complete: function(data) {
                $('.loaderbtn').hide();
                $('.savebtn').show();
            },
            error: function(e) {
                // toastr.error(data.msg, 'Something Went Wrong, Try Again later!!!', {
                //         timeOut: 3000
                //     })
                $('.loaderbtn').hide();
                $('.savebtn').show();
                console.log(e);

            }
        });



    });

    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top','77px');
        $("#details-header").removeClass('py-lg-8');
        $("#details-header").addClass('py-lg-9');
        // $("#details-header").removeClass('mt-15');
        // $("#details-header").addClass('mt-10');

    }
</script>
