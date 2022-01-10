<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/icon/site.webmanifest') }}">
    
    <title>Myfashion</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
 
        .navbar-brand {
          font-family: 'Ubuntu', sans-serif;
        }
    </style>
  </head>
  <body style="background-color: #fbfcff">
    <nav class="navbar navbar-expand-lg navbar-light " id="navbar_top" style="background-color:#fbfcff !important;height:10vh;">
        <div class="container">
            <a class="navbar-brand" style="color: #232d68;" href="{{ url('/') }}">
              @foreach($web as $webs)
                {{ $webs->name }}
              @endforeach
          </a>
        </div>
    </nav>
    <div class="container mt-3">
        @yield('container')
    </div>

    <!-- Footer -->
<footer class="text-center text-lg-start text-muted" style="background-color: #fbfcff; color: #6974b3 !important;">
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4" style="color: #232d68;">
              @foreach($web as $webs)
              <i class="fas fa-gem me-3"></i>{{ $webs->name }}
              @endforeach
            </h6>
            @foreach($web as $webs)
            <p>
              {!! $webs->description !!}
            </p>
            @endforeach
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4" style="color: #232d68;">
              Produk
            </h6>
            <p>
              <a href="#!" class="text-reset">Atasan</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Celana</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Outer</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4" style="color: #232d68;">
              Kontak
            </h6>
            @foreach($web as $webs)
            <p><i class="fas fa-home me-3"></i> {{ $webs->address }}</p>
            <p><i class="fas fa-envelope-open me-3"></i> {{ $webs->email }}</p>
            <p><i class="fas fa-phone me-3"></i> {{ $webs->phone }}</p>
            @endforeach
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
  
    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: #fbfcff">
      © 2021 Hak Cipta
      @foreach ($web as $webs)
      <a class="text-reset fw-bold" href="{{ url('/') }}">{{ $webs->name }}</a>
      @endforeach
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>