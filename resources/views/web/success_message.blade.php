@include('web.web-header')

<main id="content">
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card col-md-4 bg-white shadow-md p-5">
            <div class="mb-4 text-center">
                <svg height="10em" width="10em" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" viewBox="0 0 50 50" xml:space="preserve">
                    <circle style="fill:#25AE88;" cx="25" cy="25" r="25"/>
                    <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="  38,15 22,33 12,25 "/>
                </svg>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" viewBox="0 0 50 50" xml:space="preserve">
                    <circle style="fill:#D75A4A;" cx="25" cy="25" r="25"/>
                    <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" points="16,34 25,25 34,16   "/>
                    <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" points="16,16 25,25 34,34   "/>
                </svg> --}}
            </div>
            <div class="text-center">
                <h1>Thank You!</h1>
                {{-- <p>Thank you for your request, you will get an email confirmation soon</p> --}}

            </div>
            <div class="row justify-content-center">
                <a class="btn btn-outline-success mr-2 text-white" href="{{ url('home') }}">Go To Website</a>
                <a class="btn btn-outline-success text-white" href="{{ url('userOrders') }}">Go To Order List</a>
            </div>
        </div>
    </div>
</main>

@include('web.web-footer')
