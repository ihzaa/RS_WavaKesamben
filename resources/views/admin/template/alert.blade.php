@if (Session::get('icon'))
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        Swal.fire({
            icon: "{{ Session::get('icon') }}",
            title: "{{ Session::get('title') }}",
            text: "{{ Session::get('text') }}",
        });

    </script>
@endif
