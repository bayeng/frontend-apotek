<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.navbar')
    <main class="d-flex gap-3">
        <div class="" style="width: 15%">
            @include('includes.sidebar')
        </div>

        <main class="p-3 bg-light vh-100" style="width: 85%">
            @yield('content')
        </main>
    </main>

    @yield('script')
</body>

</html>
