@include('web.web-header')
<style>
    hr {
        border: none;
        height: 20px;
        width: 100%;
        height: 50px;
        margin-top: 0;
        border-bottom: 1px solid #1f1209;
        box-shadow: 0 20px 20px -20px #333;
        margin: -50px auto 10px;
    }
   .giving-section2-img,
    .giving-section3-img,
    .last-section-giving {
        width: 50rem;
        height: 64rem;

    }

    @media screen and (min-width: 0px) and (max-width: 614px) {

        .giving-section2-img,
        .giving-section3-img,
        .last-section-giving {
            width: 37rem;
            height: auto;
        }
    }

    @media screen and (min-width: 1650px) {
        .py-lg-18 {
            padding-top: 300px !important;
            padding-bottom: 300px !important;
        }
    }
</style>
<main id="content" style="padding-top: 111px">
<section class="py-10  py-lg-18" id="details-header"
        style="background-repeat: no-repeat; background-image: url('{{ url('assets-web') }}/images/best-banner.jpg'); background-size: cover;">
    <div class="container container-xl">

        <div class=" no-gutters" style="justify-content: center">
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Accessibilty
            </h2>
        </div>

    </div>

</section>
    <div class="container container-xxl">
        <section class="mt-16">
            {{-- <h1 style="text-align: center;">Accessibilty</h1> --}}
            <p>
            Jusout Beauty + Beauty Skin are committed to providing a website that is accessible to all audiences, regardless of technology or ability. As part of this, Fenty Beauty+ Fenty Skin aim to substantially conform to applicable guidelines, including WCAG 2.1 at levels A and AA. If you experience any difficulty in accessing any part of this website, please contact us by emailing: <b>admin@jusoutbeauty.com</b>
or calling: <b>866-848-2168</b> 
            </p>
            </section>
    </div>
    <script>
    function close_topbar(){
        $("#topbar").removeClass('d-xl-flex');
        // $("#content").css('padding-top','77px');
    
    }</script>
    @include('web.web-footer')
