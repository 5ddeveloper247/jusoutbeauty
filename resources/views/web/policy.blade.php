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
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Privacy Policy
            </h2>
        </div>

    </div>

</section>
    <div class="container container-xxl">
        <section class="mt-16">
            {{-- <h1 style="text-align: center;">Privacy Policy</h1> --}}
            <hr>
            <p>
                Barbara Sturm Molecular Cosmetics collects and uses your personal data exclusively in the framework of the
                provisions of data protection law which apply in the Federal Republic of Germany. The following explanations
                provide information about the way in which personal data is collected and used as well as the extent of such
                collection and use and its purpose. This information can be read at any time on our website.
            </p>
            <h4>
                DATE COMMUNICATION AND RECORDING FOR INSTRASYSTEM AND STATISTICAL PURPOSES
    
            </h4>
            <p>
                For technical reasons your Internet browser automatically conveys data to our web server every time you
                visit our website. Among other things your browser sends data about the date and time at which our website
                was visited, the URL of the referencing web page, the files accessed, the volume of data sent, the type and
                version of browser used, the operating system and your IP address. This data is stored separately from other
                data which is entered when using our offer. We are not able to assign this data to specific persons. The
                data is used for statistical purposes and subsequently deleted in accordance with GDPR compliance.
            </p>
            <h4>
                CUSTOMER BASIC DATA
            </h4>
            <p>
                If a contractual relationship is created between us and you or if the contents of such a contractual
                relationship are established or altered, we collect and use personal data from you to the extent that this
                is necessary for such purposes. If instructed to do so by the responsible authorities we shall be able in
                specific cases to provide information about such data (customer basic data) where the provision of such data
                is required for the purposes of criminal investigations, to avert dangers, to comply with the statutory
                duties of authorities for the protection of the constitution of the Federal Armed Forces Counterintelligence
                Office of for the purposes of asserting rights to intellectual property.
            </p>
            <h4>
                COOKIES
            </h4>
            <p>
                In order to extend the functional scope of our Internet service and to make it easier for you to use, we
                make use of "cookies". These are text files which are saved on your computer and which enable your use of
                the website to be analyzed. These cookies help us to store data on your computer when you access our
                website. You have the option of blocking the storage of cookies on your computer by changing the settings on
                your browser. If you do this, however, you may no longer be able to use all the functions which our services
                provide.
    
                THIS WEBSITE USES COOKIES. This website uses our own and 3rd party cookies to improve your experience and
                for personalised content/advertising. By clicking 'ACCEPT' you consent to our use of cookies. More info
    
                Cookies are small text files that can be used by websites to make a user's experience more efficient.
    
                The law states that we can store cookies on your device if they are strictly necessary for the operation of
                this site. For all other types of cookies we need your permission.
    
                This site uses different types of cookies. Some cookies are placed by third party services that appear on
                our pages.
    
                You can at any time change or withdraw your consent from the Cookie Declaration on our website.
    
                Learn more about who we are, how you can contact us and how we process personal data in our Privacy Policy.
    
                Please state your consent ID and date when you contact us regarding your consent.
            </p>
        </section>
    </div>
    <script>
    function close_topbar(){
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top','77px');
    
    }</script>
    @include('web.web-footer')
