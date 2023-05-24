@include('web.web-header')
<main id="content">
    <section class="pb-11 pb-lg-15 pt-10">
        <div class="container">
            <h2 class="fs-sm-40 mb-10 text-center">Register</h2>
            <div class="mw-500 mx-auto">
                <form>
                    <input name="first-name" type="text" class="form-control mb-3" placeholder="First name" required>
                    <input name="last-name" type="text" class="form-control mb-3" placeholder="Last name" required>
                    <input name="email" type="email" class="form-control mb-3" placeholder="Your email" required>
                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                    <div class="custom-control custom-checkbox mt-4 mb-5 mr-xl-6">
                        <input name="agree" type="checkbox" class="custom-control-input" id="termsOfUse1">
                        <label class="custom-control-label text-primary" for="termsOfUse1">
                            Yes, I agree with Grace <a href="#" class="text-decoration-underline">Privacy
                                Policy</a> and <a href="#" class="text-decoration-underline">Terms of Use</a>
                        </label>
                    </div>
                    <button type="submit" value="Login" class="btn btn-primary btn-block">Sign Up</button>
                    <div class="border-bottom mt-6"></div>
                    <div class="text-center mt-n2 lh-1 mb-4">
                        <span class="fs-14 bg-white lh-1 mt-n2 px-4">or Sign Up with</span>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="btn btn-outline-primary btn-block border-2x border mr-5"><i
                                class="fab fa-facebook-f mr-2" style="color: #2E58B2"></i>Facebook</a>
                        <a href="#" class="btn btn-outline-primary btn-block border-2x border mt-0"><i
                                class="fab fa-google mr-2" style="color: #DD4B39"></i>Google</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@include('web.web-footer')
