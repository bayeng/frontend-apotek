<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')

</head>

<body class="bg-light">
    @include('includes.navbar')
    <main class="d-flex gap-3">
        <div class="" style="width: 15%">
            @include('includes.sidebar')
        </div>

        <main class="p-3 bg-light vh-100" style="width: 85%">
            @yield('content')
        </main>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/alert.js')}}"></script>
    <script type="module">
        $(document).ready(function() {
            const user = JSON.parse(localStorage.getItem('user'))

            if (!user) {
                window.location.href = '/login'
            }

            if(user.role == 'PEGAWAI') {
                $('#suplier-link').remove()
                $('#user-link').remove()
                $('#obatmasuk-link').remove()

                const restrictedPaths = ['/obatmasuks', '/supliers', '/users']
                const currentPath = window.location.pathname
                const isRestricted = restrictedPaths.some(path => currentPath.includes(path));

                if (isRestricted) {
                    window.location.href = '/';
                    showNotification('error', 'Anda tidak memiliki izin untuk mengakses halaman ini')
                }
                document.getElementById('output').innerText = user.nama;
            }

            if(user.role == 'ADMIN') {
                $('#apotek-link').remove()
                $('#tujuan-link').remove()

                const restrictedPaths = ['/apotek', '/tujuan']
                const currentPath = window.location.pathname
                const isRestricted = restrictedPaths.some(path => currentPath.includes(path));

                if (isRestricted) {
                    window.location.href = '/';
                    showNotification('error', 'Anda tidak memiliki izin untuk mengakses halaman ini')
                }
                document.getElementById('output').innerText = user.nama;
            }

            $('.logout').on('click', function() {
                localStorage.removeItem('user')
                window.location.href = '/login'
            })
        })

    </script>

    @stack('scripts')
    @yield('script')
</body>

</html>
