<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src={{ Vite::asset('resources/js/header/header.js') }}></script>
<script src={{ Vite::asset('resources/js/components/dropdown.js') }}></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src={{ Vite::asset('resources/js/components/input-file.js') }}></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

