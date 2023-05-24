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
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Term Of Use
            </h2>
        </div>

    </div>

</section>
<main class="container container-xxl">
    <section class="mt-16">

        {{-- <h1 style="text-align: center;">Term & Conditions</h1> --}}
        <hr>
        <h2> SCOPE</h2>
        <p>The business relationships between Barbara Sturm Molecular Cosmetics GmbH - hereinafter referred to as "BSMC"
            - and the buyer shall be subject exclusively to the version of the following General Terms and Conditions
            applicable at the time the order is placed. Conflicting terms of business or purchase of the buyer shall
            only be deemed recognized if this has been explicitly agreed in writing. </p>
        <h2>CONCLUSION OF CONTRACT</h2>
        <p>
            By sending an order via the website the buyer makes a binding offer to BSMC to conclude a purchase
            agreement. If you place an order with BSMC we will send you an email confirming receipt by us of your order
            and the order details (confirmation of order). This confirmation of order shall not be deemed acceptance of
            your offer but shall merely inform you that we have received your order. A purchase agreement shall only
            then be concluded when we send the ordered product to you and confirm shipment to you in a second email
            (shipping confirmation). No purchase contract shall be concluded regarding products from one and the same
            order which are not stated in the confirmation of shipment. BSMC does not offer any products for purchase to
            minors. Products intended for children may likewise be only purchased by adults. Your order also functions
            as assurance that you are of legal age. We accept no liability for orders for our product placed by minors.
        </p>
        <h2>
           RIGHT TO CANCEL WITHIN 14 DAYS; EXCLUSION OF THE RIGHT TO CANCEL, NOTIFICATION OF RIGHT TO CANCEL,
           
        </h2>
        <p>
            You can revoke your contractual declaration without stating grounds within 14 days in text form (e.g.
            letter, fax, email) or if the item is transferred to you before expiry of this period - by returning the
            goods.

            The period begins after receiving this formal advice in text form but not prior to receipt of the goods by
            the recipient (in the case of the recurring delivery of similar goods, not prior to receipt of the first
            part delivery) nor prior to fulfillment of our informaiton duties pursuant to Article 246 Section 2 in
            connection with Section 1 (1) and (2) of the Introductory Law to the German Civil Code (EGBGB) and our
            duties under Section 312 g (1) Sentence 1 of the German Civil Code (BGB) in connection with Article 246
            Section 3 of the Introductory Law to the German Civil Code (EGBGB). The period will be deemed as having been
            observed if notification is sent or the delivered goods are returned within this period.

            Notification of cancellation must be sent to:
        </p>

        <h4>
            JUSOUTBEAUTY
            <br>
            Contact: 866-848-2168
            <br>
            Email: admin@jusoutbeauty.com
        </h4>
    </section>
</main>
<script>
    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top','77px');

    }
</script>
@include('web.web-footer')
