

  @include('admin.admin-header');
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
        <div class="container-fluid">
          <div class="row">
              <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
                <div class="card border-card">
                  <div class="card-body">
                    <div class="media">
                      <div class="media-body mr-3">
                        <h2 class="text-success display-4 display-md-5">{{ $getTotalUsers }}</h2>
                        <span class="position">Users</span>
                      </div>
                      <span class="cd-icon bgl-success align-center-verticle">
                         <i class="fa fa-user dashboard-user-av fa-lg fa-2x"></i>
                      </span>
                    </div>
                  </div>
                  <span class="line bg-success"></span>
                </div>
              </div>
              <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
                <div class="card border-card">
                  <div class="card-body">
                    <div class="media">
                      <div class="media-body mr-3">
                        <h2 class="text-secondary display-4 display-md-5">{{ $getTotalTickets }}</h2>
                        <span class="position">Open Tickets</span>
                      </div>
                      <span class="cd-icon bgl-secondary align-center-verticle">
                          <i class="fa fa-ticket dashboard-orders-av fa-lg fa-2x"></i>
                      </span>
                    </div>
                  </div>
                  <span class="line bg-secondary"></span>
                </div>
              </div>
              <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
                <div class="card border-card">
                  <div class="card-body">
                    <div class="media">
                      <div class="media-body mr-3">
                        <h2 class="text-warning display-4 display-md-5">{{ $getTotalProducts }}</h2>
                        <span class="position">Products</span>
                      </div>
                      <span class="cd-icon bgl-warning align-center-verticle">
                          <i class="fa fa-product-hunt fa-lg fa-2x" style="color:#ff9b52 ;"></i>
                      </span>
                    </div>
                  </div>
                  <span class="line bg-warning"></span>
                </div>
              </div>
          </div>

          @php
          $checkOrderStats = 'd-none';
          @endphp


         @foreach ($adminMenu as $item)
            @if ($item['MENU_NAME'] == 'Dashboard Order Stats')
                @php
                $checkOrderStats = '';
                @endphp
            @endif
        @endforeach

          <div class="row <?php echo $checkOrderStats ?>">
            <div class="col-xl-12">
            <div class="card">
              <div class="card-header border-0 pb-0 flex-wrap">
                <h4 class="fs-20 text-black mr-4 mb-2">Order Stats</h4>

                <div class="dropdown custom-dropdown mb-0 mt-3 mt-sm-0 mb-2">
                  {{-- <div class="btn border text-black rounded" role="button" data-toggle="dropdown" aria-expanded="false">
                    This Month
                    <i class="las la-angle-down scale5 text-primary ml-3"></i>
                  </div> --}}
                  {{-- <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:void(0);">This Month</a>
                    <a class="dropdown-item" href="javascript:void(0);">January</a>
                    <a class="dropdown-item" href="javascript:void(0);">February</a>
                    <a class="dropdown-item" href="javascript:void(0);">March</a>
                    <a class="dropdown-item" href="javascript:void(0);">April</a>
                    <a class="dropdown-item" href="javascript:void(0);">May</a>
                    <a class="dropdown-item" href="javascript:void(0);">June</a>
                    <a class="dropdown-item" href="javascript:void(0);">Jully</a>
                    <a class="dropdown-item" href="javascript:void(0);">August</a>
                    <a class="dropdown-item" href="javascript:void(0);">September</a>
                    <a class="dropdown-item" href="javascript:void(0);">October</a>
                    <a class="dropdown-item" href="javascript:void(0);">November</a>
                    <a class="dropdown-item" href="javascript:void(0);">Decemeber</a>
                    <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                  </div> --}}
                </div>
              </div>
              <div class="card-body">
                <div id="lineChart" class="line-chart"></div>
                <div class="d-flex flex-wrap align-items-center justify-content-center mt-3">
                  <div class="fs-14 text-black mr-4">
                    <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="19" height="19" rx="9.5" fill="#2BC155"/>
                    </svg>
                    Orders
                  </div>
                  {{-- <div class="fs-14 text-black mr-4">
                    <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="19" height="19" rx="9.5" fill="#3F9AE0"/>
                    </svg>
                    Hair
                  </div>
                  <div class="fs-14 text-black">
                    <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="19" height="19" rx="9.5" fill="#FF424D"/>
                    </svg>
                    Eyes
                  </div> --}}
                </div>
              </div>
            </div>
            </div>
          </div>


          <div class="row">

            @php
            $checkDashboardPayments = 'd-none';
            @endphp


        @foreach ($adminMenu as $item)
            @if ($item['MENU_NAME'] == 'Dashboard payments')
                @php
                $checkDashboardPayments = '';
                @endphp
            @endif
        @endforeach
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6 <?php echo $checkDashboardPayments ?>">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-success display-4 display-md-5 ">{{ $getTotalPayments }}</h2>
                      <span class="position">Payments</span>
                    </div>
                    <span class="cd-icon bgl-success align-center-verticle">
                      <i class="fa fa-credit-card fa-lg fa-2x" style="color:#45c96b;"></i>
                    </span>
                  </div>

                </div>
                <span class="line bg-success"></span>
              </div>
            </div>

            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-secondary display-4 display-md-5 ">{{ $getTotalBundles }}</h2>
                      <span class="position">Bundles</span>
                    </div>
                    <span class="cd-icon bgl-secondary align-center-verticle">
                        {{-- <svg style="position: relative;top:16px;left:14px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z" fill="#3f9ae0"/></svg> --}}
                        {{-- <i class="fa-solid fa-layer-group" style="color:#3f9ae0"></i> --}}
                        <i class="fa fa-database fa-lg fa-2x" style="color:#3f9ae0"></i>
                    </span>
                  </div>
                </div>
                <span class="line bg-secondary"></span>
              </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-warning display-4 display-md-5 ">{{ $getTotalBlogs }}</h2>
                      <span class="position">Blogs</span>
                    </div>
                    <span class="cd-icon bgl-warning align-center-verticle">
                      {{-- <i class="fab fa-blogger-b" style=" font-size: 40px ;color:#ff9b52 ;"></i> --}}
                      <i class="fa fa-rss-square fa-lg fa-2x" aria-hidden="true" style="color:#ff9b52"></i>
                      {{-- <svg style="position: relative;top:16px;left:14px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M172.2 226.8c-14.6-2.9-28.2 8.9-28.2 23.8V301c0 10.2 7.1 18.4 16.7 22 18.2 6.8 31.3 24.4 31.3 45 0 26.5-21.5 48-48 48s-48-21.5-48-48V120c0-13.3-10.7-24-24-24H24c-13.3 0-24 10.7-24 24v248c0 89.5 82.1 160.2 175 140.7 54.4-11.4 98.3-55.4 109.7-109.7 17.4-82.9-37-157.2-112.5-172.2zM209 0c-9.2-.5-17 6.8-17 16v31.6c0 8.5 6.6 15.5 15 15.9 129.4 7 233.4 112 240.9 241.5.5 8.4 7.5 15 15.9 15h32.1c9.2 0 16.5-7.8 16-17C503.4 139.8 372.2 8.6 209 0zm.3 96c-9.3-.7-17.3 6.7-17.3 16.1v32.1c0 8.4 6.5 15.3 14.8 15.9 76.8 6.3 138 68.2 144.9 145.2.8 8.3 7.6 14.7 15.9 14.7h32.2c9.3 0 16.8-8 16.1-17.3-8.4-110.1-96.5-198.2-206.6-206.7z" fill="#ff9b52"/></svg> --}}
                    </span>
                  </div>
                </div>
                <span class="line bg-warning"></span>
              </div>
            </div>
          </div>


          @php
          $checkproducts = 'd-none';
         @endphp

      @foreach ($adminMenu as $item)
            @if ($item['MENU_NAME'] == 'Dashboard products')
                @php
                $checkproducts = '';
                @endphp
            @endif
      @endforeach

          <div class="row <?php echo $checkproducts ?>" >
            <div class="col-xl-12">
              <div class="d-sm-flex align-items-center mb-sm-3 mt-sm-2 mt-2  mb-2">
                <h4 class="fs-20 text-black mr-auto mb-sm-0 mb-2">Products</h4>
                <a href="{{ url('view-products') }}" class="btn btn-outline-primary rounded mb-sm-0 mb-1">View More</a>
              </div>
              <div class="testimonial-one owl-carousel">
                @forelse ($mostSaledItems as $item)
                  <div class="item" >
                    <div class="card">
                      <div class="card-body">
                        <div class="media pb-4 border-bottom mb-4 align-items-center">

                          <img src="{{ url($item['productImage']) }}" class="dashboard-product-img">
                          <div class="media-body">
                            <h4 class="fs-20"><a href="#" class="text-black">{{ $item['productName'] }}</a></h4>
                            <div class="d-flex">
                              <p class="mb-0 mr-auto">{{ $item['categoryName'] }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex mb-3">
                          <span class="text-black mr-auto font-w500">
                            <svg class="mr-3" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip3)">
                              <path d="M14.0001 7.83997C10.5987 7.83997 7.65356 10.2024 6.91568 13.5229L4.49921 24.397C4.48149 24.4768 4.47254 24.5583 4.47254 24.64C4.47254 25.2585 4.97398 25.76 5.59254 25.76H22.4077C22.4894 25.76 22.5709 25.751 22.6507 25.7333C23.2545 25.5991 23.6352 25.0008 23.501 24.397L21.0846 13.5229C20.3467 10.2024 17.4016 7.83997 14.0001 7.83997ZM14.0001 5.59997C18.4515 5.59997 22.3056 8.69164 23.2712 13.037L25.6877 23.9111C26.0902 25.7226 24.9481 27.5174 23.1366 27.92C22.8973 27.9731 22.6529 28 22.4077 28H5.59254C3.73687 28 2.23254 26.4956 2.23254 24.64C2.23254 24.3948 2.25937 24.1504 2.31256 23.9111L4.72902 13.037C5.69466 8.69164 9.54877 5.59997 14.0001 5.59997Z" fill="#A9A9A9"/>
                              <path d="M16.2402 12.32C16.8588 12.32 17.3602 12.8214 17.3602 13.44C17.3602 14.0585 16.8588 14.56 16.2402 14.56H13.4402C13.1309 14.56 12.8802 14.8107 12.8802 15.12C12.8802 15.4292 13.1309 15.68 13.4402 15.68H14.5602C16.1066 15.68 17.3602 16.9336 17.3602 18.48C17.3602 20.0264 16.1066 21.28 14.5602 21.28H11.7602C11.1416 21.28 10.6402 20.7785 10.6402 20.16C10.6402 19.5414 11.1416 19.04 11.7602 19.04H14.5602C14.8695 19.04 15.1202 18.7892 15.1202 18.48C15.1202 18.1707 14.8695 17.92 14.5602 17.92H13.4402C11.8938 17.92 10.6402 16.6664 10.6402 15.12C10.6402 13.5736 11.8938 12.32 13.4402 12.32H16.2402Z" fill="#A9A9A9"/>
                              <path d="M12.8802 11.2C12.8802 10.5814 13.3817 10.08 14.0002 10.08C14.6188 10.08 15.1203 10.5814 15.1203 11.2V13.44C15.1203 14.0586 14.6188 14.56 14.0002 14.56C13.3817 14.56 12.8802 14.0586 12.8802 13.44V11.2Z" fill="#A9A9A9"/>
                              <path d="M15.1203 22.4C15.1203 23.0186 14.6188 23.52 14.0002 23.52C13.3817 23.52 12.8802 23.0186 12.8802 22.4V20.16C12.8802 19.5414 13.3817 19.04 14.0002 19.04C14.6188 19.04 15.1203 19.5414 15.1203 20.16V22.4Z" fill="#A9A9A9"/>
                              <path d="M12.8001 6.30404C13.0298 6.87836 12.7504 7.53017 12.1761 7.75989C11.6018 7.98962 10.95 7.71027 10.7203 7.13596L8.48027 1.53596C8.11627 0.625951 9.01409 -0.279605 9.92718 0.0765737C10.7659 0.403728 11.391 0.56 11.7602 0.56C11.8521 0.56 11.9283 0.540358 12.0946 0.469683C12.1387 0.450919 12.1906 0.428012 12.3122 0.374186C12.8915 0.12032 13.3491 -3.76254e-07 14.0002 -3.76254e-07C14.6497 -3.76254e-07 15.1146 0.12064 15.6957 0.372056C15.8432 0.43663 15.9021 0.462313 15.9542 0.483786C16.0978 0.542916 16.1669 0.56 16.2402 0.56C16.5878 0.56 17.2185 0.402322 18.0812 0.0734544C18.9932 -0.274175 19.8825 0.629785 19.5201 1.53596L17.2801 7.13596C17.0503 7.71027 16.3985 7.98962 15.8242 7.75989C15.2499 7.53017 14.9705 6.87836 15.2003 6.30404L16.6096 2.78073C16.4808 2.79355 16.3578 2.8 16.2402 2.8C15.8314 2.8 15.4927 2.7162 15.1013 2.55506C15.0241 2.52324 14.9394 2.4863 14.8064 2.42794C14.4822 2.28767 14.2985 2.24 14.0002 2.24C13.7048 2.24 13.5313 2.28561 13.2114 2.42581C13.1015 2.47449 13.0319 2.50524 12.9706 2.53126C12.5512 2.70952 12.2002 2.8 11.7602 2.8C11.6419 2.8 11.5189 2.79386 11.3911 2.78165L12.8001 6.30404Z" fill="#A9A9A9"/>
                              </g>
                              <defs>
                              <clipPath id="clip3">
                              <rect width="28" height="28" fill="white"/>
                              </clipPath>
                              </defs>
                            </svg>
                            {{ $item['productprice'] }}</span>
                        </div>
                        <div class="d-flex mb-3">
                          <span class="text-black mr-auto font-w500">
                            <i class="fa fa-database dashboard-custom-icon"></i>
                            {{ $item['productTotalUnits'] }}</span>
                        </div>
                        <div>
                          <i class="fa fa-cart-arrow-down dashboard-custom-icon"></i>
                          {{ $item['revenue'] }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty

                @endforelse


                {{-- <div class="items">
                  <div class="card">
                    <div class="card-body">
                      <div class="media pb-4 border-bottom mb-4 align-items-center">

                        <img src="{{ url('/assets-admin') }}/images/admin/big/img5.jpg" class="dashboard-product-img">
                        <div class="media-body">
                          <h4 class="fs-20"><a href="#" class="text-black">Red Lipstick</a></h4>
                          <div class="d-flex">
                            <p class="mb-0 mr-auto">Lipstick</p>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <svg class="mr-3" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip3)">
                            <path d="M14.0001 7.83997C10.5987 7.83997 7.65356 10.2024 6.91568 13.5229L4.49921 24.397C4.48149 24.4768 4.47254 24.5583 4.47254 24.64C4.47254 25.2585 4.97398 25.76 5.59254 25.76H22.4077C22.4894 25.76 22.5709 25.751 22.6507 25.7333C23.2545 25.5991 23.6352 25.0008 23.501 24.397L21.0846 13.5229C20.3467 10.2024 17.4016 7.83997 14.0001 7.83997ZM14.0001 5.59997C18.4515 5.59997 22.3056 8.69164 23.2712 13.037L25.6877 23.9111C26.0902 25.7226 24.9481 27.5174 23.1366 27.92C22.8973 27.9731 22.6529 28 22.4077 28H5.59254C3.73687 28 2.23254 26.4956 2.23254 24.64C2.23254 24.3948 2.25937 24.1504 2.31256 23.9111L4.72902 13.037C5.69466 8.69164 9.54877 5.59997 14.0001 5.59997Z" fill="#A9A9A9"/>
                            <path d="M16.2402 12.32C16.8588 12.32 17.3602 12.8214 17.3602 13.44C17.3602 14.0585 16.8588 14.56 16.2402 14.56H13.4402C13.1309 14.56 12.8802 14.8107 12.8802 15.12C12.8802 15.4292 13.1309 15.68 13.4402 15.68H14.5602C16.1066 15.68 17.3602 16.9336 17.3602 18.48C17.3602 20.0264 16.1066 21.28 14.5602 21.28H11.7602C11.1416 21.28 10.6402 20.7785 10.6402 20.16C10.6402 19.5414 11.1416 19.04 11.7602 19.04H14.5602C14.8695 19.04 15.1202 18.7892 15.1202 18.48C15.1202 18.1707 14.8695 17.92 14.5602 17.92H13.4402C11.8938 17.92 10.6402 16.6664 10.6402 15.12C10.6402 13.5736 11.8938 12.32 13.4402 12.32H16.2402Z" fill="#A9A9A9"/>
                            <path d="M12.8802 11.2C12.8802 10.5814 13.3817 10.08 14.0002 10.08C14.6188 10.08 15.1203 10.5814 15.1203 11.2V13.44C15.1203 14.0586 14.6188 14.56 14.0002 14.56C13.3817 14.56 12.8802 14.0586 12.8802 13.44V11.2Z" fill="#A9A9A9"/>
                            <path d="M15.1203 22.4C15.1203 23.0186 14.6188 23.52 14.0002 23.52C13.3817 23.52 12.8802 23.0186 12.8802 22.4V20.16C12.8802 19.5414 13.3817 19.04 14.0002 19.04C14.6188 19.04 15.1203 19.5414 15.1203 20.16V22.4Z" fill="#A9A9A9"/>
                            <path d="M12.8001 6.30404C13.0298 6.87836 12.7504 7.53017 12.1761 7.75989C11.6018 7.98962 10.95 7.71027 10.7203 7.13596L8.48027 1.53596C8.11627 0.625951 9.01409 -0.279605 9.92718 0.0765737C10.7659 0.403728 11.391 0.56 11.7602 0.56C11.8521 0.56 11.9283 0.540358 12.0946 0.469683C12.1387 0.450919 12.1906 0.428012 12.3122 0.374186C12.8915 0.12032 13.3491 -3.76254e-07 14.0002 -3.76254e-07C14.6497 -3.76254e-07 15.1146 0.12064 15.6957 0.372056C15.8432 0.43663 15.9021 0.462313 15.9542 0.483786C16.0978 0.542916 16.1669 0.56 16.2402 0.56C16.5878 0.56 17.2185 0.402322 18.0812 0.0734544C18.9932 -0.274175 19.8825 0.629785 19.5201 1.53596L17.2801 7.13596C17.0503 7.71027 16.3985 7.98962 15.8242 7.75989C15.2499 7.53017 14.9705 6.87836 15.2003 6.30404L16.6096 2.78073C16.4808 2.79355 16.3578 2.8 16.2402 2.8C15.8314 2.8 15.4927 2.7162 15.1013 2.55506C15.0241 2.52324 14.9394 2.4863 14.8064 2.42794C14.4822 2.28767 14.2985 2.24 14.0002 2.24C13.7048 2.24 13.5313 2.28561 13.2114 2.42581C13.1015 2.47449 13.0319 2.50524 12.9706 2.53126C12.5512 2.70952 12.2002 2.8 11.7602 2.8C11.6419 2.8 11.5189 2.79386 11.3911 2.78165L12.8001 6.30404Z" fill="#A9A9A9"/>
                            </g>
                            <defs>
                            <clipPath id="clip3">
                            <rect width="28" height="28" fill="white"/>
                            </clipPath>
                            </defs>
                          </svg>
                        $14</span>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <i class="fa fa-database dashboard-custom-icon"></i>
                        200</span>
                      </div>
                      <div>
                        <i class="fa fa-cart-arrow-down dashboard-custom-icon"></i>
                        1500</span>
                      </div>
                    </div>
                  </div>
                </div> --}}

                {{-- <div class="items">
                  <div class="card">
                    <div class="card-body">
                      <div class="media pb-4 border-bottom mb-4 align-items-center">

                        <img src="{{ url('/assets-admin') }}/images/admin/big/img5.jpg" class="dashboard-product-img">
                        <div class="media-body">
                          <h4 class="fs-20"><a href="#" class="text-black">Red Lipstick</a></h4>
                          <div class="d-flex">
                            <p class="mb-0 mr-auto">Lipstick</p>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <svg class="mr-3" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip3)">
                            <path d="M14.0001 7.83997C10.5987 7.83997 7.65356 10.2024 6.91568 13.5229L4.49921 24.397C4.48149 24.4768 4.47254 24.5583 4.47254 24.64C4.47254 25.2585 4.97398 25.76 5.59254 25.76H22.4077C22.4894 25.76 22.5709 25.751 22.6507 25.7333C23.2545 25.5991 23.6352 25.0008 23.501 24.397L21.0846 13.5229C20.3467 10.2024 17.4016 7.83997 14.0001 7.83997ZM14.0001 5.59997C18.4515 5.59997 22.3056 8.69164 23.2712 13.037L25.6877 23.9111C26.0902 25.7226 24.9481 27.5174 23.1366 27.92C22.8973 27.9731 22.6529 28 22.4077 28H5.59254C3.73687 28 2.23254 26.4956 2.23254 24.64C2.23254 24.3948 2.25937 24.1504 2.31256 23.9111L4.72902 13.037C5.69466 8.69164 9.54877 5.59997 14.0001 5.59997Z" fill="#A9A9A9"/>
                            <path d="M16.2402 12.32C16.8588 12.32 17.3602 12.8214 17.3602 13.44C17.3602 14.0585 16.8588 14.56 16.2402 14.56H13.4402C13.1309 14.56 12.8802 14.8107 12.8802 15.12C12.8802 15.4292 13.1309 15.68 13.4402 15.68H14.5602C16.1066 15.68 17.3602 16.9336 17.3602 18.48C17.3602 20.0264 16.1066 21.28 14.5602 21.28H11.7602C11.1416 21.28 10.6402 20.7785 10.6402 20.16C10.6402 19.5414 11.1416 19.04 11.7602 19.04H14.5602C14.8695 19.04 15.1202 18.7892 15.1202 18.48C15.1202 18.1707 14.8695 17.92 14.5602 17.92H13.4402C11.8938 17.92 10.6402 16.6664 10.6402 15.12C10.6402 13.5736 11.8938 12.32 13.4402 12.32H16.2402Z" fill="#A9A9A9"/>
                            <path d="M12.8802 11.2C12.8802 10.5814 13.3817 10.08 14.0002 10.08C14.6188 10.08 15.1203 10.5814 15.1203 11.2V13.44C15.1203 14.0586 14.6188 14.56 14.0002 14.56C13.3817 14.56 12.8802 14.0586 12.8802 13.44V11.2Z" fill="#A9A9A9"/>
                            <path d="M15.1203 22.4C15.1203 23.0186 14.6188 23.52 14.0002 23.52C13.3817 23.52 12.8802 23.0186 12.8802 22.4V20.16C12.8802 19.5414 13.3817 19.04 14.0002 19.04C14.6188 19.04 15.1203 19.5414 15.1203 20.16V22.4Z" fill="#A9A9A9"/>
                            <path d="M12.8001 6.30404C13.0298 6.87836 12.7504 7.53017 12.1761 7.75989C11.6018 7.98962 10.95 7.71027 10.7203 7.13596L8.48027 1.53596C8.11627 0.625951 9.01409 -0.279605 9.92718 0.0765737C10.7659 0.403728 11.391 0.56 11.7602 0.56C11.8521 0.56 11.9283 0.540358 12.0946 0.469683C12.1387 0.450919 12.1906 0.428012 12.3122 0.374186C12.8915 0.12032 13.3491 -3.76254e-07 14.0002 -3.76254e-07C14.6497 -3.76254e-07 15.1146 0.12064 15.6957 0.372056C15.8432 0.43663 15.9021 0.462313 15.9542 0.483786C16.0978 0.542916 16.1669 0.56 16.2402 0.56C16.5878 0.56 17.2185 0.402322 18.0812 0.0734544C18.9932 -0.274175 19.8825 0.629785 19.5201 1.53596L17.2801 7.13596C17.0503 7.71027 16.3985 7.98962 15.8242 7.75989C15.2499 7.53017 14.9705 6.87836 15.2003 6.30404L16.6096 2.78073C16.4808 2.79355 16.3578 2.8 16.2402 2.8C15.8314 2.8 15.4927 2.7162 15.1013 2.55506C15.0241 2.52324 14.9394 2.4863 14.8064 2.42794C14.4822 2.28767 14.2985 2.24 14.0002 2.24C13.7048 2.24 13.5313 2.28561 13.2114 2.42581C13.1015 2.47449 13.0319 2.50524 12.9706 2.53126C12.5512 2.70952 12.2002 2.8 11.7602 2.8C11.6419 2.8 11.5189 2.79386 11.3911 2.78165L12.8001 6.30404Z" fill="#A9A9A9"/>
                            </g>
                            <defs>
                            <clipPath id="clip3">
                            <rect width="28" height="28" fill="white"/>
                            </clipPath>
                            </defs>
                          </svg>
                        $14</span>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <i class="fa fa-database dashboard-custom-icon"></i>
                        200</span>
                      </div>
                      <div>
                        <i class="fa fa-cart-arrow-down dashboard-custom-icon"></i>
                        1500</span>
                      </div>
                    </div>
                  </div>
                </div> --}}

                {{-- <div class="items">
                  <div class="card">
                    <div class="card-body">
                      <div class="media pb-4 border-bottom mb-4 align-items-center">

                        <img src="{{ url('/assets-admin') }}/images/admin/big/img5.jpg" class="dashboard-product-img">
                        <div class="media-body">
                          <h4 class="fs-20"><a href="#" class="text-black">Red Lipstick</a></h4>
                          <div class="d-flex">
                            <p class="mb-0 mr-auto">Lipstick</p>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <svg class="mr-3" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip3)">
                            <path d="M14.0001 7.83997C10.5987 7.83997 7.65356 10.2024 6.91568 13.5229L4.49921 24.397C4.48149 24.4768 4.47254 24.5583 4.47254 24.64C4.47254 25.2585 4.97398 25.76 5.59254 25.76H22.4077C22.4894 25.76 22.5709 25.751 22.6507 25.7333C23.2545 25.5991 23.6352 25.0008 23.501 24.397L21.0846 13.5229C20.3467 10.2024 17.4016 7.83997 14.0001 7.83997ZM14.0001 5.59997C18.4515 5.59997 22.3056 8.69164 23.2712 13.037L25.6877 23.9111C26.0902 25.7226 24.9481 27.5174 23.1366 27.92C22.8973 27.9731 22.6529 28 22.4077 28H5.59254C3.73687 28 2.23254 26.4956 2.23254 24.64C2.23254 24.3948 2.25937 24.1504 2.31256 23.9111L4.72902 13.037C5.69466 8.69164 9.54877 5.59997 14.0001 5.59997Z" fill="#A9A9A9"/>
                            <path d="M16.2402 12.32C16.8588 12.32 17.3602 12.8214 17.3602 13.44C17.3602 14.0585 16.8588 14.56 16.2402 14.56H13.4402C13.1309 14.56 12.8802 14.8107 12.8802 15.12C12.8802 15.4292 13.1309 15.68 13.4402 15.68H14.5602C16.1066 15.68 17.3602 16.9336 17.3602 18.48C17.3602 20.0264 16.1066 21.28 14.5602 21.28H11.7602C11.1416 21.28 10.6402 20.7785 10.6402 20.16C10.6402 19.5414 11.1416 19.04 11.7602 19.04H14.5602C14.8695 19.04 15.1202 18.7892 15.1202 18.48C15.1202 18.1707 14.8695 17.92 14.5602 17.92H13.4402C11.8938 17.92 10.6402 16.6664 10.6402 15.12C10.6402 13.5736 11.8938 12.32 13.4402 12.32H16.2402Z" fill="#A9A9A9"/>
                            <path d="M12.8802 11.2C12.8802 10.5814 13.3817 10.08 14.0002 10.08C14.6188 10.08 15.1203 10.5814 15.1203 11.2V13.44C15.1203 14.0586 14.6188 14.56 14.0002 14.56C13.3817 14.56 12.8802 14.0586 12.8802 13.44V11.2Z" fill="#A9A9A9"/>
                            <path d="M15.1203 22.4C15.1203 23.0186 14.6188 23.52 14.0002 23.52C13.3817 23.52 12.8802 23.0186 12.8802 22.4V20.16C12.8802 19.5414 13.3817 19.04 14.0002 19.04C14.6188 19.04 15.1203 19.5414 15.1203 20.16V22.4Z" fill="#A9A9A9"/>
                            <path d="M12.8001 6.30404C13.0298 6.87836 12.7504 7.53017 12.1761 7.75989C11.6018 7.98962 10.95 7.71027 10.7203 7.13596L8.48027 1.53596C8.11627 0.625951 9.01409 -0.279605 9.92718 0.0765737C10.7659 0.403728 11.391 0.56 11.7602 0.56C11.8521 0.56 11.9283 0.540358 12.0946 0.469683C12.1387 0.450919 12.1906 0.428012 12.3122 0.374186C12.8915 0.12032 13.3491 -3.76254e-07 14.0002 -3.76254e-07C14.6497 -3.76254e-07 15.1146 0.12064 15.6957 0.372056C15.8432 0.43663 15.9021 0.462313 15.9542 0.483786C16.0978 0.542916 16.1669 0.56 16.2402 0.56C16.5878 0.56 17.2185 0.402322 18.0812 0.0734544C18.9932 -0.274175 19.8825 0.629785 19.5201 1.53596L17.2801 7.13596C17.0503 7.71027 16.3985 7.98962 15.8242 7.75989C15.2499 7.53017 14.9705 6.87836 15.2003 6.30404L16.6096 2.78073C16.4808 2.79355 16.3578 2.8 16.2402 2.8C15.8314 2.8 15.4927 2.7162 15.1013 2.55506C15.0241 2.52324 14.9394 2.4863 14.8064 2.42794C14.4822 2.28767 14.2985 2.24 14.0002 2.24C13.7048 2.24 13.5313 2.28561 13.2114 2.42581C13.1015 2.47449 13.0319 2.50524 12.9706 2.53126C12.5512 2.70952 12.2002 2.8 11.7602 2.8C11.6419 2.8 11.5189 2.79386 11.3911 2.78165L12.8001 6.30404Z" fill="#A9A9A9"/>
                            </g>
                            <defs>
                            <clipPath id="clip3">
                            <rect width="28" height="28" fill="white"/>
                            </clipPath>
                            </defs>
                          </svg>
                        $14</span>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <i class="fa fa-database dashboard-custom-icon"></i>
                        200</span>
                      </div>
                      <div>
                        <i class="fa fa-cart-arrow-down dashboard-custom-icon"></i>
                        1500</span>
                      </div>
                    </div>
                  </div>
                </div> --}}

                {{-- <div class="items">
                  <div class="card">
                    <div class="card-body">
                      <div class="media pb-4 border-bottom mb-4 align-items-center">

                        <img src="{{ url('/assets-admin') }}/images/admin/big/img5.jpg" class="dashboard-product-img">
                        <div class="media-body">
                          <h4 class="fs-20"><a href="#" class="text-black">Red Lipstick</a></h4>
                          <div class="d-flex">
                            <p class="mb-0 mr-auto">Lipstick</p>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <svg class="mr-3" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip3)">
                            <path d="M14.0001 7.83997C10.5987 7.83997 7.65356 10.2024 6.91568 13.5229L4.49921 24.397C4.48149 24.4768 4.47254 24.5583 4.47254 24.64C4.47254 25.2585 4.97398 25.76 5.59254 25.76H22.4077C22.4894 25.76 22.5709 25.751 22.6507 25.7333C23.2545 25.5991 23.6352 25.0008 23.501 24.397L21.0846 13.5229C20.3467 10.2024 17.4016 7.83997 14.0001 7.83997ZM14.0001 5.59997C18.4515 5.59997 22.3056 8.69164 23.2712 13.037L25.6877 23.9111C26.0902 25.7226 24.9481 27.5174 23.1366 27.92C22.8973 27.9731 22.6529 28 22.4077 28H5.59254C3.73687 28 2.23254 26.4956 2.23254 24.64C2.23254 24.3948 2.25937 24.1504 2.31256 23.9111L4.72902 13.037C5.69466 8.69164 9.54877 5.59997 14.0001 5.59997Z" fill="#A9A9A9"/>
                            <path d="M16.2402 12.32C16.8588 12.32 17.3602 12.8214 17.3602 13.44C17.3602 14.0585 16.8588 14.56 16.2402 14.56H13.4402C13.1309 14.56 12.8802 14.8107 12.8802 15.12C12.8802 15.4292 13.1309 15.68 13.4402 15.68H14.5602C16.1066 15.68 17.3602 16.9336 17.3602 18.48C17.3602 20.0264 16.1066 21.28 14.5602 21.28H11.7602C11.1416 21.28 10.6402 20.7785 10.6402 20.16C10.6402 19.5414 11.1416 19.04 11.7602 19.04H14.5602C14.8695 19.04 15.1202 18.7892 15.1202 18.48C15.1202 18.1707 14.8695 17.92 14.5602 17.92H13.4402C11.8938 17.92 10.6402 16.6664 10.6402 15.12C10.6402 13.5736 11.8938 12.32 13.4402 12.32H16.2402Z" fill="#A9A9A9"/>
                            <path d="M12.8802 11.2C12.8802 10.5814 13.3817 10.08 14.0002 10.08C14.6188 10.08 15.1203 10.5814 15.1203 11.2V13.44C15.1203 14.0586 14.6188 14.56 14.0002 14.56C13.3817 14.56 12.8802 14.0586 12.8802 13.44V11.2Z" fill="#A9A9A9"/>
                            <path d="M15.1203 22.4C15.1203 23.0186 14.6188 23.52 14.0002 23.52C13.3817 23.52 12.8802 23.0186 12.8802 22.4V20.16C12.8802 19.5414 13.3817 19.04 14.0002 19.04C14.6188 19.04 15.1203 19.5414 15.1203 20.16V22.4Z" fill="#A9A9A9"/>
                            <path d="M12.8001 6.30404C13.0298 6.87836 12.7504 7.53017 12.1761 7.75989C11.6018 7.98962 10.95 7.71027 10.7203 7.13596L8.48027 1.53596C8.11627 0.625951 9.01409 -0.279605 9.92718 0.0765737C10.7659 0.403728 11.391 0.56 11.7602 0.56C11.8521 0.56 11.9283 0.540358 12.0946 0.469683C12.1387 0.450919 12.1906 0.428012 12.3122 0.374186C12.8915 0.12032 13.3491 -3.76254e-07 14.0002 -3.76254e-07C14.6497 -3.76254e-07 15.1146 0.12064 15.6957 0.372056C15.8432 0.43663 15.9021 0.462313 15.9542 0.483786C16.0978 0.542916 16.1669 0.56 16.2402 0.56C16.5878 0.56 17.2185 0.402322 18.0812 0.0734544C18.9932 -0.274175 19.8825 0.629785 19.5201 1.53596L17.2801 7.13596C17.0503 7.71027 16.3985 7.98962 15.8242 7.75989C15.2499 7.53017 14.9705 6.87836 15.2003 6.30404L16.6096 2.78073C16.4808 2.79355 16.3578 2.8 16.2402 2.8C15.8314 2.8 15.4927 2.7162 15.1013 2.55506C15.0241 2.52324 14.9394 2.4863 14.8064 2.42794C14.4822 2.28767 14.2985 2.24 14.0002 2.24C13.7048 2.24 13.5313 2.28561 13.2114 2.42581C13.1015 2.47449 13.0319 2.50524 12.9706 2.53126C12.5512 2.70952 12.2002 2.8 11.7602 2.8C11.6419 2.8 11.5189 2.79386 11.3911 2.78165L12.8001 6.30404Z" fill="#A9A9A9"/>
                            </g>
                            <defs>
                            <clipPath id="clip3">
                            <rect width="28" height="28" fill="white"/>
                            </clipPath>
                            </defs>
                          </svg>
                        $14</span>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <i class="fa fa-database dashboard-custom-icon"></i>
                        200</span>
                      </div>
                      <div>
                        <i class="fa fa-cart-arrow-down dashboard-custom-icon"></i>
                        1500</span>
                      </div>
                    </div>
                  </div>
                </div> --}}

                {{-- <div class="items">
                  <div class="card">
                    <div class="card-body">
                      <div class="media pb-4 border-bottom mb-4 align-items-center">

                        <img src="{{ url('/assets-admin') }}/images/admin/big/img5.jpg" class="dashboard-product-img">
                        <div class="media-body">
                          <h4 class="fs-20"><a href="#" class="text-black">Red Lipstick</a></h4>
                          <div class="d-flex">
                            <p class="mb-0 mr-auto">Lipstick</p>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <svg class="mr-3" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip3)">
                            <path d="M14.0001 7.83997C10.5987 7.83997 7.65356 10.2024 6.91568 13.5229L4.49921 24.397C4.48149 24.4768 4.47254 24.5583 4.47254 24.64C4.47254 25.2585 4.97398 25.76 5.59254 25.76H22.4077C22.4894 25.76 22.5709 25.751 22.6507 25.7333C23.2545 25.5991 23.6352 25.0008 23.501 24.397L21.0846 13.5229C20.3467 10.2024 17.4016 7.83997 14.0001 7.83997ZM14.0001 5.59997C18.4515 5.59997 22.3056 8.69164 23.2712 13.037L25.6877 23.9111C26.0902 25.7226 24.9481 27.5174 23.1366 27.92C22.8973 27.9731 22.6529 28 22.4077 28H5.59254C3.73687 28 2.23254 26.4956 2.23254 24.64C2.23254 24.3948 2.25937 24.1504 2.31256 23.9111L4.72902 13.037C5.69466 8.69164 9.54877 5.59997 14.0001 5.59997Z" fill="#A9A9A9"/>
                            <path d="M16.2402 12.32C16.8588 12.32 17.3602 12.8214 17.3602 13.44C17.3602 14.0585 16.8588 14.56 16.2402 14.56H13.4402C13.1309 14.56 12.8802 14.8107 12.8802 15.12C12.8802 15.4292 13.1309 15.68 13.4402 15.68H14.5602C16.1066 15.68 17.3602 16.9336 17.3602 18.48C17.3602 20.0264 16.1066 21.28 14.5602 21.28H11.7602C11.1416 21.28 10.6402 20.7785 10.6402 20.16C10.6402 19.5414 11.1416 19.04 11.7602 19.04H14.5602C14.8695 19.04 15.1202 18.7892 15.1202 18.48C15.1202 18.1707 14.8695 17.92 14.5602 17.92H13.4402C11.8938 17.92 10.6402 16.6664 10.6402 15.12C10.6402 13.5736 11.8938 12.32 13.4402 12.32H16.2402Z" fill="#A9A9A9"/>
                            <path d="M12.8802 11.2C12.8802 10.5814 13.3817 10.08 14.0002 10.08C14.6188 10.08 15.1203 10.5814 15.1203 11.2V13.44C15.1203 14.0586 14.6188 14.56 14.0002 14.56C13.3817 14.56 12.8802 14.0586 12.8802 13.44V11.2Z" fill="#A9A9A9"/>
                            <path d="M15.1203 22.4C15.1203 23.0186 14.6188 23.52 14.0002 23.52C13.3817 23.52 12.8802 23.0186 12.8802 22.4V20.16C12.8802 19.5414 13.3817 19.04 14.0002 19.04C14.6188 19.04 15.1203 19.5414 15.1203 20.16V22.4Z" fill="#A9A9A9"/>
                            <path d="M12.8001 6.30404C13.0298 6.87836 12.7504 7.53017 12.1761 7.75989C11.6018 7.98962 10.95 7.71027 10.7203 7.13596L8.48027 1.53596C8.11627 0.625951 9.01409 -0.279605 9.92718 0.0765737C10.7659 0.403728 11.391 0.56 11.7602 0.56C11.8521 0.56 11.9283 0.540358 12.0946 0.469683C12.1387 0.450919 12.1906 0.428012 12.3122 0.374186C12.8915 0.12032 13.3491 -3.76254e-07 14.0002 -3.76254e-07C14.6497 -3.76254e-07 15.1146 0.12064 15.6957 0.372056C15.8432 0.43663 15.9021 0.462313 15.9542 0.483786C16.0978 0.542916 16.1669 0.56 16.2402 0.56C16.5878 0.56 17.2185 0.402322 18.0812 0.0734544C18.9932 -0.274175 19.8825 0.629785 19.5201 1.53596L17.2801 7.13596C17.0503 7.71027 16.3985 7.98962 15.8242 7.75989C15.2499 7.53017 14.9705 6.87836 15.2003 6.30404L16.6096 2.78073C16.4808 2.79355 16.3578 2.8 16.2402 2.8C15.8314 2.8 15.4927 2.7162 15.1013 2.55506C15.0241 2.52324 14.9394 2.4863 14.8064 2.42794C14.4822 2.28767 14.2985 2.24 14.0002 2.24C13.7048 2.24 13.5313 2.28561 13.2114 2.42581C13.1015 2.47449 13.0319 2.50524 12.9706 2.53126C12.5512 2.70952 12.2002 2.8 11.7602 2.8C11.6419 2.8 11.5189 2.79386 11.3911 2.78165L12.8001 6.30404Z" fill="#A9A9A9"/>
                            </g>
                            <defs>
                            <clipPath id="clip3">
                            <rect width="28" height="28" fill="white"/>
                            </clipPath>
                            </defs>
                          </svg>
                        $14</span>
                      </div>
                      <div class="d-flex mb-3">
                        <span class="text-black mr-auto font-w500">
                          <i class="fa fa-database dashboard-custom-icon"></i>
                        200</span>
                      </div>
                      <div>
                        <i class="fa fa-cart-arrow-down dashboard-custom-icon"></i>
                        1500</span>
                      </div>
                    </div>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-success display-4 display-md-5">{{ $getTotalOrders }}</h2>
                      <span class="position">Orders</span>
                    </div>
                    <span class="cd-icon bgl-successalign-center-verticle">
                         <i class="fa fa-first-order fa-lg fa-2x" style="font-size: 40px;color:#45c96b;"></i>
                    </span>
                  </div>
                </div>
                <span class="line bg-success"></span>
              </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-secondary display-4 display-md-5">{{ $getShippedOrders }}</h2>
                      <span class="position">Shipped</span>
                    </div>
                    <span class="cd-icon bgl-secondary align-center-verticle">
                        <i class="fa fa-ship dashboard-orders-av fa-lg fa-2x"></i>
                    </span>
                  </div>
                </div>
                <span class="line bg-secondary"></span>
              </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-warning display-4 display-md-5">{{ $getTotalInTransitOrders }}</h2>
                      <span class="position">In Transit</span>
                    </div>
                    <span class="cd-icon bgl-warning align-center-verticle">
                        <i class="fa fa-truck fa-lg fa-2x" style="color:#ff9b52 ;"></i>
                    </span>
                  </div>
                </div>
                <span class="line bg-warning"></span>
              </div>
            </div>
          </div>


            @php
                $checkusers = 'd-none';
            @endphp

            @foreach ($adminMenu as $item)
                @if ($item['MENU_NAME'] == 'Dashboard Users')
                    @php
                    $checkusers = '';
                    @endphp
                @endif
            @endforeach


          <div class="row <?php echo $checkusers ?>">
            <div class="col-xl-12">
              <div class="d-sm-flex align-items-center mb-sm-3 mt-sm-2 mt-2  mb-2">
                <h4 class="fs-20 text-black mr-auto mb-sm-0 mb-2">Admin Users</h4>
                {{-- <a href="#" class="btn btn-outline-primary rounded mb-sm-0 mb-1">View More</a> --}}
              </div>
            </div>

            <div class="col-xl-12">
              <div class="row sp-sm-15">

                @forelse ($getAdminUsers as $AdminUser)
                <div class="col-xl-2 col-xxl-3 col-lg-3 col-md-4 col-6 clickable-div " style="cursor: pointer;" onclick="showAdmin({{ $AdminUser->USER_ID }})">
                  <div class="card text-center">
                    <div class="card-body">
                      <img src="{{ url('/assets-admin') }}/images/admin/profile/user.png" class="dashboard-users-img">
                      <h6 class="font-w600 fs-16 mb-1"><a href="#" class="text-black">{{ $AdminUser->FIRST_NAME }} {{ $AdminUser->LAST_NAME }}</a></h6>
                      <span class="text-primary">3 Roles</span>
                    </div>
                  </div>
                </div>
                @empty

                @endforelse

              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-success display-4 display-md-5">{{ $getTotalSubscriptions }}</h2>
                      <span class="position">Total Subscriptions</span>
                    </div>
                    <span class="cd-icon bgl-success align-center-verticle">
                      <i class="fa fa-ticket fa-lg fa-2x" style="color:#45c96b;"></i>
                    </span>
                  </div>
                </div>
                <span class="line bg-success"></span>
              </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-secondary display-4 display-md-5">{{ $getTotalReviews }}</h2>
                      <span class="position">Reviews</span>
                    </div>
                    <span class="cd-icon bgl-secondary align-center-verticle">
                        <i class="fa fa-comments dashboard-orders-av fa-lg fa-2x"></i>
                    </span>
                  </div>
                </div>
                <span class="line bg-secondary"></span>
              </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-lg-4 col-sm-6">
              <div class="card border-card">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body mr-3">
                      <h2 class="text-warning display-4 display-md-5">{{ $getTotalGivings}}</h2>
                      <span class="position">Total Givings</span>
                    </div>
                    <span class="cd-icon bgl-warning align-center-verticle">
                        <i class="fa fa-usd fa-lg fa-2x" style="color:#ff9b52" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
                <span class="line bg-warning"></span>
              </div>
            </div>
          </div>
        </div>

          {{-- <div class="col-xl-3 col-xxl-4">
            <div class="row">
              <div class="col-xl-12">
                <div class="card d-flex flex-xl-column flex-sm-column flex-md-row flex-column">
                  <div class="card-body text-center border-bottom profile-bx">
                    <div class="profile-image mb-4">
                      <img src="{{ url('/assets-admin') }}/images/admin/avatar/1.jpg" class="rounded-circle" alt="">
                    </div>
                    <h4 class="fs-22 text-black mb-1">{{session('firstName')}} {{session('lastName')}}</h4>
                    <p class="mb-4">Admin User</p>

                  </div>
                  <div class="card-body col-xl-12 col-md-6 col-sm-12 pb-0">
                    <h4 class="fs-18 text-black mb-3">Recent Activities</h4>
                    <div class="media mb-4">
                      <span class="p-3 bgl-primary mr-3 rounded">
                        <svg class="primary-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip1)">
                          <path d="M20.3955 10.8038C19.9733 10.8038 19.5767 10.8742 19.2057 11.0213V4.79104H12.9883C13.1226 4.42004 13.193 4.01066 13.193 3.58849C13.193 1.60554 11.5874 0 9.60447 0C7.62152 0 6.01598 1.60554 6.01598 3.58849C6.01598 4.01066 6.08634 4.41365 6.22067 4.79104H0.00958252V11.7441C0.642845 11.1684 1.48719 10.8102 2.4083 10.8102C4.39125 10.8102 5.99679 12.4158 5.99679 14.3987C5.99679 16.3817 4.39125 17.9872 2.4083 17.9872C1.48719 17.9872 0.642845 17.629 0.00958252 17.0533V24H19.2121V17.7697C19.5831 17.9104 19.9797 17.9872 20.4019 17.9872C22.3912 17.9872 23.9904 16.3817 23.9904 14.3987C23.9904 12.4158 22.3912 10.8038 20.3955 10.8038Z" fill="#8743DF"/>
                          </g>
                          <defs>
                          <clipPath id="clip1">
                          <rect width="24" height="24" fill="white"/>
                          </clipPath>
                          </defs>
                        </svg>
                      </span>
                      <div class="media-body">
                        <p class="fs-14 mb-1 text-black font-w500">You Have changed status of 3 orders</p>
                        <span class="fs-14">12h ago</span>
                      </div>
                    </div>
                    <div class="media mb-4">
                      <span class="p-3 bgl-primary mr-3 rounded">
                        <svg class="primary-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#clip2)">
                          <path d="M20.3955 10.8038C19.9733 10.8038 19.5767 10.8742 19.2057 11.0213V4.79104H12.9883C13.1226 4.42004 13.193 4.01066 13.193 3.58849C13.193 1.60554 11.5874 0 9.60447 0C7.62152 0 6.01598 1.60554 6.01598 3.58849C6.01598 4.01066 6.08634 4.41365 6.22067 4.79104H0.00958252V11.7441C0.642845 11.1684 1.48719 10.8102 2.4083 10.8102C4.39125 10.8102 5.99679 12.4158 5.99679 14.3987C5.99679 16.3817 4.39125 17.9872 2.4083 17.9872C1.48719 17.9872 0.642845 17.629 0.00958252 17.0533V24H19.2121V17.7697C19.5831 17.9104 19.9797 17.9872 20.4019 17.9872C22.3912 17.9872 23.9904 16.3817 23.9904 14.3987C23.9904 12.4158 22.3912 10.8038 20.3955 10.8038Z" fill="#8743DF"/>
                          </g>
                          <defs>
                          <clipPath id="clip2">
                          <rect width="24" height="24" fill="white"/>
                          </clipPath>
                          </defs>
                        </svg>
                      </span>
                      <div class="media-body">
                        <p class="fs-14 mb-1 text-black font-w500">You have updated a parnter</p>
                        <span class="fs-14">12h ago</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}



        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <script>
      var linechartmonths = {!! json_encode($lineChartData["month"]) !!};
      var linechartorders = {!! json_encode($lineChartData["total_orders"]) !!};

    function showAdmin($id){
        window.location.href = 'admin-users';
        localStorage.setItem('adminId', $id);

    }
    </script>
     @include('admin.admin-footer');
