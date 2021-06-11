{{-- swal alert success --}}
@if (session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Informasi Pesan',
        text: `{{ session()->get('success ') }}`
    })
</script>
@endif

{{-- swal alert error --}}
@if (session()->has('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Informasi Pesan',
        text: `{{ session()->get('error') }}`
    })
</script>
@endif

<script>
    window.addEventListener('swal:modal', event => {
        Swal.fire({
            icon: event.detail.type,
            title: event.detail.title,
            text: event.detail.text
        })
    })

    window.addEventListener('swal:confirm', event => {
        Swal.fire({
            icon: event.detail.type,
            title: event.detail.title,
            text: event.detail.text,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus ini!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                window.livewire.emit('delete', event.detail.id)
            }
        })
    })
</script>
