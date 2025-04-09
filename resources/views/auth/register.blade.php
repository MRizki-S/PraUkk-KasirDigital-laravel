<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Left Section -->
        <div class="w-full md:w-[60%] bg-white flex flex-col justify-center items-center p-8 gradient-bg text-white">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4">Welcome!</h1>
                <p class="text-lg font-medium mb-6">Register to continue</p>
                <img src="{{ asset('img/login-img.png') }}" alt="Login Illustration" class="w-3/4 mx-auto">
            </div>
        </div>

        <!-- Right Section -->
        <div class="w-full md:w-[40%] flex flex-col justify-center items-center p-8 bg-white">
            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Register</h2>
                <p class="text-gray-600 mb-6">Create an account to access your account</p>
                <form action="/registration" method="post">
                    @csrf
                    @if (Session::has('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ Session::get('success') }}</span>
                            <button class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                onclick="this.parentElement.remove();">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="bg-red-100 mb-2 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ Session::get('error') }}</span>
                            <button class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                onclick="this.parentElement.remove();">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-gray-700" for="username">Username</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute top-3 left-3 text-gray-400"></i>
                            <input
                                class="w-full px-10 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                                id="username" name="username" placeholder="your username" type="username"
                                value="{{ old('username') }}" />
                            @error('username')
                                <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700" for="email">Email Address</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute top-3 left-3 text-gray-400"></i>
                            <input
                                class="w-full px-10 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                                id="email" name="email" placeholder="name@example.com" type="email"
                                value="{{ old('email') }}" />
                            @error('email')
                                <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700" for="password">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute top-3 left-3 text-gray-400"></i>
                            <input
                                class="w-full px-10 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                                id="password" name="password" placeholder="••••••••" type="password"
                                value="{{ old('password') }}" />
                            @error('password')
                                <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button
                        class="w-full py-2 rounded-lg text-white font-semibold transition duration-200 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-indigo-600 hover:to-blue-600"
                        type="submit">
                        Create Account
                    </button>

                    <p class="mt-4 text-center text-gray-600">
                        Already have an account? <a href="/login" class="text-blue-600 font-semibold hover:underline">Log in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
