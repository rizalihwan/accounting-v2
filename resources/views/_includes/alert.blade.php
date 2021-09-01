{{-- swal alert success --}}
@if (session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: `{{ session()->get('success ') }}`
    })
</script>
@endif

{{-- swal alert error --}}
@if (session()->has('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: `{{ session()->get('error') }}`
    })
</script>
@endif

<script>
    window.addEventListener('swal:modal', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            customClass: {
                confirmButton: "btn btn-primary"
            },
            buttonsStyling: !1
        })
    })

    window.addEventListener('swal:confirm', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            showCancelButton: !0,
            confirmButtonText: "Ya, hapus ini!",
            customClass:{
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-outline-danger ml-1"
            },
            buttonsStyling:!1
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                window.livewire.emit('delete', event.detail.id)
            }
        })
    })
</script>
