<!--**********************************
Scripts
***********************************-->
<script src="{{ asset('assets/backend/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/settings.js') }}"></script>
<script src="{{ asset('assets/backend/js/gleek.js') }}"></script>
<script src="{{ asset('assets/backend/js/styleSwitcher.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/backend/js/sweetalert2@11.js') }}"></script>
<!-- Chartjs -->
<script src="{{ asset('assets/backend/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Circle progress -->
<script src="{{ asset('assets/backend/plugins/circle-progress/circle-progress.min.js') }}"></script>
<!-- Datamap -->
<script src="{{ asset('assets/backend/plugins/d3v3/index.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/topojson/topojson.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/datamaps/datamaps.world.min.js') }}"></script>
<!-- Morrisjs -->
<script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/morris/morris.min.js') }}"></script>
<!-- Pignose Calender -->
<script src="{{ asset('assets/backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
<!-- ChartistJS -->
<script src="{{ asset('assets/backend/plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

<script src="{{ asset('assets/backend/js/dashboard/dashboard-1.js') }}"></script>

<!-- jqueryui date picker -->
<script src="{{ asset('assets/backend/js/jQuery/jquery-ui.js') }}"></script>

<!-- jqueryui date picker -->
<script>
$( function() {
$( ".jqdatepicker" ).datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    yearRange: '2000:2025'
});
});
</script>

<script>
    tinymce.init({
        selector: '#richTextEditor1',
        // plugins: [ 'quickbars' ],
        plugins: 'lists advlist autolink link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount',
        toolbar: 'numlist bullist link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount'
    });
    tinymce.init({
        selector: '#richTextEditor2',
        // plugins: [ 'quickbars' ],
        plugins: 'lists advlist autolink link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount',
        toolbar: 'numlist bullist link table image charmap print preview hr anchor pagebreak insertdatetime media searchreplace wordcount'
    });
</script>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    @if (session()->has('success'))
        Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}'
        })
    @endif

    @if (session()->has('error'))
        Toast.fire({
        icon: 'error',
        title: '{{ session('error') }}'
        })
    @endif

    @if (session()->has('warning'))
        Toast.fire({
        icon: 'warning',
        title: '{{ session('warning') }}'
        })
    @endif
    
</script>

@yield('custom_js')