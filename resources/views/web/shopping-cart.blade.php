@include('web.web-header')
<main id="content">
    <section class="pb-10 pt-6">
        <div class="container">
            <h1 class="fs-42 mb-2 text-center">Shopping Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center fs-15 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="index.html">Shop</a>
                    </li>
                    <li class="breadcrumb-item active pl-0 d-flex align-items-center text-primary" aria-current="page">
                        Shopping Cart
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pb-11 pb-lg-15">
        <div class="container">
            <form>
                <div class="row">
                    <div class="col-lg-9 mb-9 mb-lg-0 pr-lg-13">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="border-bottom pl-0 pb-3">
                                            <p class="fs-15 text-primary mb-0"><span
                                                    class="d-inline-block mr-2 fs-14"><i
                                                        class="far fa-check-circle"></i></span>
                                                Your cart is saved for the next <span
                                                    class="font-weight-600">4m34s</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-0 py-6 align-middle"><a href="#" class="d-block mr-4"><i
                                                    class="fal fa-times"></i></a></td>
                                        <td class="py-6 pl-0">
                                            <div class="media">
                                                <div class="w-90px mr-4">
                                                    <img src="images/produuct.jpg" alt="Partridge Bar Stool">
                                                </div>
                                                <div class="media-body">
                                                    <p
                                                        class="text-muted fs-12 mb-0 text-uppercase letter-spacing-05 lh-1 mb-1 font-weight-500">
                                                        Dress</p>
                                                    <a href="#" class="font-weight-bold mb-1 d-block">Oversize
                                                        cotton sweatshirt</a>
                                                    <p class="fs-15 text-primary d-block mb-0">Min / S</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-0 py-6">
                                            <div class="input-group position-relative w-100px">
                                                <a href="#"
                                                    class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i
                                                        class="far fa-minus"></i></a>
                                                <input name="number[]" type="number"
                                                    class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px"
                                                    value="1" required>
                                                <a href="#"
                                                    class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i
                                                        class="far fa-plus"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="pl-0 py-6">
                                            <p class="mb-0 ml-12 text-primary">1 x $750.00</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-0 py-6 align-middle"><a href="#" class="d-block mr-4"><i
                                                    class="fal fa-times"></i></a></td>
                                        <td class="py-6 pl-0">
                                            <div class="media">
                                                <div class="w-90px mr-4">
                                                    <img src="images/product.jpg" alt="Partridge Bar Stool">
                                                </div>
                                                <div class="media-body">
                                                    <p
                                                        class="text-muted fs-12 mb-0 text-uppercase letter-spacing-05 lh-1 mb-1 font-weight-500">
                                                        Dress</p>
                                                    <a href="#" class="font-weight-bold mb-1 d-block">Oversize
                                                        cotton sweatshirt</a>
                                                    <p class="fs-15 text-primary d-block mb-0">Min / S</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pl-0 py-6">
                                            <div class="input-group position-relative w-100px">
                                                <a href="#"
                                                    class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i
                                                        class="far fa-minus"></i></a>
                                                <input name="number[]" type="number"
                                                    class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px"
                                                    value="1" required>
                                                <a href="#"
                                                    class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i
                                                        class="far fa-plus"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="pl-0 py-6">
                                            <p class="mb-0 ml-12 text-primary">1 x $750.00</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="fs-15 text-primary pt-1 mb-0">
                            <span class="d-inline-block mr-2 fs-14"><i class="fas fa-info-circle"></i></span>
                            Special instruction for seller
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-header border-0 bg-transparent p-0">
                                <h4 class="card-title fs-24 mb-0">Summary</h4>
                            </div>
                            <div class="card-body pt-6 px-0 pb-4">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="text-primary">Subtotal</span>
                                    <span class="d-block ml-auto text-primary">$2000.00</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="text-primary">Shipping</span>
                                    <span class="d-block ml-auto text-primary">$20.00</span>
                                </div>
                            </div>
                            <div class="card-footer pt-4 px-0 bg-transparent">
                                <div class="d-flex align-items-center font-weight-bold mb-7">
                                    <span class="text-primary">Total</span>
                                    <span class="font-weight-normal d-block ml-auto mr-1">USD</span>
                                    <span class="d-block text-primary">$2020.00</span>
                                </div>
                                <input type="text" name="coupon" class="form-control w-100 text-primary mb-3"
                                    placeholder="Enter coupon code here">
                                <input type="submit" class="btn btn-primary btn-block" value="Check Out">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
@include('web.web-footer')
