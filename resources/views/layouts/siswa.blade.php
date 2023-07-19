<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}">
  <title>
    Polling
  </title>
  {{-- bootstarp icon --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('frontend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('frontend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('frontend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('frontend/assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  @stack('css')
</head>

<body class="g-sidenav-show  bg-gray-100">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    {{-- Main --}}
    @yield("content")
    {{-- End Main --}}

    <div class="container">
        <footer style="margin-bottom: 10px;" class="footer w-100 py-1 pt-3 blur shadow-blur bg-white mt-4 border-radius-xl">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        <p style="font-size: 12px">
                            Compyright © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">SMKN 1 KATAPANG</a>
                            for a better web.
                        </p>
                    </div>
                </div>
                </div>
            </div>
        </footer>
    </div>

  </main>

  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Pengaturan</h5>
          <p>Dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>

        <div class="mt-3">
            <h6 class="mb-0">Keluar</h6>
        </div>
        <div class="d-flex">
            <form action="{{ route('logout') }}" method="POST" class="w-100">
                @csrf
                <button type="submit" class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent">Keluar</button>
            </form>
        </div>

      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('frontend/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('frontend/assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}")
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}")
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}")
    @endif
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("nama");
        event.preventDefault();
        swal({
            title: `Apa Kamu Yakin?`,
            text: "ingin memvote sekarang",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            form.submit();
            }
        });
    });

</script>

  @stack('js')
</body>

</html>
