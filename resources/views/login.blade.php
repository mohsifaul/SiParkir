<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SiParkir</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    
    .card {
      width: 350px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      background-color: #ffffff;
    }
  </style>
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        @include('sweetalert::alert')
        <!-- Isi card Anda di sini -->
        <div>
            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 700;" class="mb-0">SiParkir</h1>
            <p style="font-family: 'Poppins', sans-serif; font-weight: 500;">Sistem Infromasi Manajemen Parkir</p>
            <hr>
        </div>
        <form action="{{ route('masuk') }}" method="POST">
            @csrf
            <div class="mb-3" style="font-family: 'Poppins', sans-serif; font-weight: 700;">
                <label for="formGroupExampleInput" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" id="formGroupExampleInput" placeholder="Masukkan Username" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Masukkan alamat email yang valid" name="email">
                </div>
                <div class="invalid-feedback" style="display: none; color: red; font-size: 14px;">Email tidak valid</div>
            </div>
            <div class="mb-3" style="font-family: 'Poppins', sans-serif; font-weight: 700;">
                <label for="formGroupExampleInput2" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Masukkan Password" name="password">
                </div>
            </div>
            <div style="font-family: 'Poppins', sans-serif; font-weight: 700;">
                <button type="submit" class="btn btn-primary w-100" style="background-color: #0F2B36; border : none">Masuk</button>
            </div>
        </form>
    </div>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        document.getElementById('formGroupExampleInput').addEventListener('blur', function() {
            if (!this.validity.valid) {
                document.querySelector('.invalid-feedback').style.display = 'block';
            } else {
                document.querySelector('.invalid-feedback').style.display = 'none';
            }
        });

    </script>
</body>

</html>