<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="{{ asset('backend/img/icons/icon-48x48.png') }}" />

    <title>Trang Quản Trị - QLBH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Quan trọng: Phải có asset để Laravel tìm đúng file trong thư mục public --}}
    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('admin.partials.sidebar')

        <div class="main">
            @include('admin.partials.topnav')

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            @include('admin.partials.footer')
        </div>
    </div>

    <script src="{{ asset('backend/js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>