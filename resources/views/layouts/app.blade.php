<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSN | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- Toastr  -->
    <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
    <!-- Date Time Picker  -->
    <link href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"
          rel="stylesheet"/>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Custom style -->
@stack('styles')
<!-- Live wire style -->
    <livewire:styles/>
</head>
<body class=" hold-transition sidebar-mini text-sm
    ">
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
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- Date Time Picker  -->
<script src="https://unpkg.com/moment"></script>
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

{{--<script>
    $(document).ready(function () {
        $('#appointmentDate').datetimepicker({
            format: 'L'
        });

        $('#appointmentDate').on("change.datetimepicker", function (e) {
            let date = $(this).data('appointmentdate')
            eval(date).set('state.date', $('#appointmentDateInput').val())
        });

        $('#appointmentTime').datetimepicker({
            format: 'LT'
        });

        $('#appointmentTime').on("change.datetimepicker", function (e) {
            let time = $(this).data('appointmenttime')
            eval(time).set('state.time', $('#appointmentTimeInput').val())
        });
    });

</script>--}}

<script>
    $(document).ready(function () {
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        }

        window.addEventListener('hide-form', event => {
            $('#cu-form').modal('hide');
            toastr.success(event.detail.message, 'Success!')
        })
    });
</script>

<script>
    window.addEventListener('show-form', event => {
        $('#cu-form').modal('show');
    })

    window.addEventListener('alert', event => {
        toastr.success(event.detail.message, 'Success!')
    })

    window.addEventListener('updated', event => {
        toastr.success(event.detail.message, 'Success!')
    })
</script>

<!-- Custom Script -->
@stack('js')
<!-- Livewire Script -->
<livewire:scripts/>
</body>
</html>
