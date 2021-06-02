{{-- swal alert success --}}
@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Informasi Pesan',
            text: '{{ session()->get('success') }}'
        })

    </script>
@endif

{{-- swal alert error --}}
@if (session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Informasi Pesan',
            text: '{{ session()->get('error') }}'
        })

    </script>
@endif
