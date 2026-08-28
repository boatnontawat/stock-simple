<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ระบบคลังเวชภัณฑ์')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Sarabun', 'sans-serif'] } } },
        };
    </script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 min-h-screen">
    <header class="bg-slate-900 text-white px-4 py-4 md:px-6">
        <h1 class="text-lg font-semibold">ระบบคลังเวชภัณฑ์</h1>
    </header>

    <main class="max-w-5xl mx-auto p-4 md:p-6">
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 text-green-700 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 text-red-700 px-4 py-3 text-sm">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
