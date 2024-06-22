<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <!-- Pastikan jQuery di-load -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <main class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="bg-white w-50 p-5 shadow rounded-3 overflow-hidden">
            <div class="d-flex justify-content-center ">
                <div
                    class="w-100 min-h-lg-screen d-flex flex-column justify-content-center py-lg-16 px-lg-20 position-relative">
                    <div class="row">
                        <div class="w-100 mx-auto">
                            <div class="text-center mb-5">
                                <h1 class="ls-tight font-bolder h2 mb-0">
                                    Selamat Datang!
                                </h1>
                                <p class="mt-2">di Sistem Informasi Apotek</p>
                            </div>
                            <form id="login-form">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        autocomplete="current-password" required>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="check_example"
                                            id="check_example">
                                        <label class="form-check-label" for="check_example">
                                            Keep me logged in
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-full">
                                        Masuk
                                    </button>
                                </div>
                                <div id="error-message" class="text-danger mt-3"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#login-form').on('submit', function(event) {
                event.preventDefault();

                let username = $('#username').val();
                let password = $('#password').val();

                $.ajax({
                    url: "{{ env('API_URL') }}/login",
                    method: 'POST',
                    data: {
                        username: username,
                        password: password
                    }
                }).done(function(data) {
                    if (data.success) {
                        localStorage.setItem('user', JSON.stringify(data.data));
                        window.location.href = '/';
                    } else {
                        $('#error-message').text('Login gagal. Silakan periksa kembali username dan password Anda.');
                    }
                }).fail(function(xhr, status, error) {
                    $('#error-message').text('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
                });
            });
        });
    </script>
</body>

</html>
