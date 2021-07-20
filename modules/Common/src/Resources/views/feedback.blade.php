
@if(session()->has('feedback'))
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-start',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    Toast.fire({
    icon: '{{session()->get('feedback')['status']}}',
    title: '{{session()->get('feedback')['message']}}'
    })
@endif
