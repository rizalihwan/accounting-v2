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
