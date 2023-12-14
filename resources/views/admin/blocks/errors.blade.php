@if(session('error'))
    <script>
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command: toastr.error(" {{ session('error') }}")
    </script>
@endif

@if(session('success'))
    <script>
        toastr.options = {
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            preventDuplicates: !1,
            showDuration: 300,
            hideDuration: 1e3,
            timeOut: 5e3,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        Command: toastr.success(" {{ session('success') }}")
    </script>
@endif
