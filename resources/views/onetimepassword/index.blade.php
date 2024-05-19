<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>One Time Password - Verify</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">One Time Password</h5>
                  </div>
                  <div class="mt-2 text-center" id="message">
                   
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="#" > @csrf
                    <div class="mb-3">
                        <p class="text-left text-wrap">We've sent an <strong>OTP (One Time Password)</strong> to <strong>{{ $email }}</strong>. Please enter the OTP to verify your email.
                        Please check the spam folder if you don't find the email in your inbox.</p>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">One Time Password</label>
                      <div class="input-group has-validation">
                        <input id="email_otp" type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email_otp" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="submit_otp_button" type="button">Submit</button>
                    </div>


                  </form>

                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    $.ajaxSetup({
        headers: {  'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }
    });
    $(document).ready(function () {
        $('#message').html(' ');
        $("#submit_otp_button").click(function () {
            var email_otp = $("#email_otp").val();
            var email = "{{ $email }}";
            console.log(email_otp);
            $.ajax({
                url: `{{ route('OtpVerify') }}`,
                method: 'POST',
                data: {
                    email: email,
                    otp: email_otp
                },
                success:function(response){
                    console.log(response);
                    if(response.status == 200) {
                        window.location.href = '/home';
                    }
                    if (response.status == 500) {
                        $('#message').html(`<div class="alert alert-danger" role="alert">${response.message}</div>`)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status === 429) {
                        $('#message').html(`<div class="alert alert-danger" role="alert">You have exceeded the rate limit. Please wait a moment and try again.</div>`)
                    }
                }
            });
      });
    });
  </script>
</body>
</html>