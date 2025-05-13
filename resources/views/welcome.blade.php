<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Task Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CDN for demo purpose -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center space-y-6">
            <h1 class="text-4xl font-bold">Welcome to Task Management System</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">Manage your tasks efficiently with user and admin access</p>

            @if (Route::has('admin.login'))
                <div class="flex justify-center space-x-4">
                    @auth('admin')
                        <a href="{{ url('/admin/dashboard') }}" class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                            Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('admin.login') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                            Admin Login
                        </a>

                        @if (Route::has('admin.register'))
                            <a href="{{ route('admin.register') }}" class="px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition">
                                Admin Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>

</body>
</html>

