<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src={{ Vite::asset('resources/js/header/header.js') }}></script>
<script src={{ Vite::asset('resources/js/components/dropdown.js') }}></script>
<script src={{ Vite::asset('resources/js/components/pagination.js') }}></script>
<script src={{ Vite::asset('resources/js/components/orderBy.js') }}></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src={{ Vite::asset('resources/js/components/input-file.js') }}></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ Vite::asset('resources/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
{{-- Variable global para acceder a las imágenes en resources --}}
<script>
    const asset_global_images = '{{ Vite::asset('/resources/images') }}';
</script>
<script>
    AOS.init();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@dashboardcode/bsmultiselect@1.1.18/dist/js/BsMultiSelect.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@dashboardcode/bsmultiselect@1.1.18/dist/js/BsMultiSelect.esm.min.js"></script>
