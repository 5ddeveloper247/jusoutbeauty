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
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Cookie Policy
            </h2>
        </div>

    </div>

</section>
    <div class="container container-xxl">
        <section class="mt-16">
            {{-- <h1 style="text-align: center;">Cookie Policy</h1> --}}
            <h3>About this cookie policy</h3>
                <p>
                    This Cookie Policy explains what cookies are and how we use them, the types of cookies we use i.e, the information we collect using cookies and how that information is used, and how to control the cookie preferences. For further information on how we use, store, and keep your personal data secure, see our Privacy Policy.You can at any time change or withdraw your consent from the Cookie Declaration on our websiteLearn more about who we are, how you can contact us, and how we process personal data in our Privacy Policy
               </p>
               <h3>What are cookies?</h3>
                <p>
               Cookies are small text files that are used to store small pieces of information. They are stored on your device when the website is loaded on your browser. These cookies help us make the website function properly, make it more secure, provide better user experience, and understand how the website performs and to analyze what works and where it needs improvement.
            </p>
               <h3>
                How do we use cookies?
                </h3>   
            
                <p>
                As most of the online services, our website uses first-party and third-party cookies for several purposes. First-party cookies are mostly necessary for the website to function the right way, and they do not collect any of your personally identifiable data.The third-party cookies used on our website are mainly for understanding how the website performs, how you interact with our website, keeping our services secure, providing advertisements that are relevant to you, and all in all providing you with a better and improved user experience and help speed up your future interactions with our website.

                </p>
                <h3>
                    What types of cookies do we use?
                </h3>
                <p>
                <b>Essential:</b> Some cookies are essential for you to be able to experience the full functionality of our site. They allow us to maintain user sessions and prevent any security threats. They do not collect or store any personal information. For example, these cookies allow you to log-in to your account and add products to your basket, and checkout securely.
                </p>

                <p>
                    <b>Statistics:</b> These cookies store information like the number of visitors to the website, the number of unique visitors, which pages of the website have been visited, the source of the visit, etc. These data help us understand and analyze how well the website performs and where it needs improvement.
                </p>
                <p>
                    <b>Marketing:</b> Our website displays advertisements. These cookies are used to personalize the advertisements that we show to you so that they are meaningful to you. These cookies also help us keep track of the efficiency of these ad campaigns.
The information stored in these cookies may also be used by the third-party ad providers to show you ads on other websites on the browser as well.


                </p>
                <p>
                    <b>Functional:</b> These are the cookies that help certain non-essential functionalities on our website. These functionalities include embedding content like videos or sharing content of the website on social media platforms.
                </p>
                <p>
                    <b>Preferences:</b> These cookies help us store your settings and browsing preferences like language preferences so that you have a better and efficient experience on future visits to the website.
                </p>
                
            </section>
    </div>
    <script>
    function close_topbar(){
        $("#topbar").removeClass('d-xl-flex');
        // $("#content").css('padding-top','77px');
    
    }</script>
    @include('web.web-footer')
