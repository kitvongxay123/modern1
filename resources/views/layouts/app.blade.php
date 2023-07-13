<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('../plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('../dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/toastr/toastr.min.css')}}">

 @livewireStyles
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <!-- Navbar -->
 @include('layouts.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 @include('layouts.partials.aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{ $slot }}
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('../plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('../plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{  asset('../dist/js/adminlte.min.js') }}"></script>

<script type="text/javascript" src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

<script>
    $(document).ready(function(){
        toastr.options = {
            "positionClass":"toast-bottom-right",
            "progressBar": true,
        }

        window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
        toastr.success(event.detail.message, 'Success!');
    })

    });
</script>

<script>
    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    })

    window.addEventListener('show-delete-modal', event =>{
        $('#confirmationModal').modal('show');
    })

    window.addEventListener('hide-delete-modal', event =>{
        $('#confirmationModal').modal('hide');
        toastr.success(event.detail.message, 'Success!' )

    })
</script>

@livewireScripts
</body>
</html>

