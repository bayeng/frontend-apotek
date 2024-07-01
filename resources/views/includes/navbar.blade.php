<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary sticky-top shadow-sm">
    <div class="container-fluid px-5 d-flex justify-content-between">
        <a class="navbar-brand fw-semibold" href="#">APOTEK</a>
        <ul class="navbar-nav">
            <!-- Avatar -->
            <li class="nav-item dropdown">
                <a data-mdb-dropdown-init class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                    id="navbarDropdownMenuLink" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                        height="22" alt="Portrait of a Woman" loading="lazy" />
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <button type="button" class="logout dropdown-item" href="#">Logout</button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

@section('script')
<script type="module">
    $('.logout').on('click', function() {
        localStorage.removeItem('user')
        window.location.href = '/login'
    })
</script>
@endsection
