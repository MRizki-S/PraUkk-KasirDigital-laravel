<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')

    <style>
        body {
            background-color: #f4f4f4
        }
    </style>


</head>
<body class="flex justify-center items-center h-screen">
    <div class="bg-white px-6 py-8 rounded-lg shadow-lg w-full max-w-md border border-t-4 border-t-blue-700">

        <h1 class="text-2xl text-blue-700 font-bold mb-4 text-center">Sign Up</h1>
        <p class="text-gray-500 text-sm text-center mb-6">Please enter your email and password fro created account.</p>
        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

        <form action="/registration" method="post">
            @csrf

            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                <input type="text" id="username" name="username" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                       placeholder="Enter your username" value="{{ old('username') }}">
                @error('username')
                       <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 font-medium mb-2">Full name</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                       placeholder="Enter your full name" value="{{ old('nama_lengkap') }}">
                @error('nama_lengkap')
                   <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                <input type="email" id="email" name="email" reqsuired
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                       placeholder="Enter your email" value="{{ old('email') }}">
                @error('email')
                   <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" requiredaa
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none focus:border-blue-400 placeholder-gray-400"
                       placeholder="Enter your password" value="{{ old('password') }}">
                @error('password')
                   <p class=" text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                           class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div> --}}

            <!-- Login Button -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                Register
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Already have an account?
                <a href="/login" class="text-blue-600 hover:underline">Sign in</a>
            </p>
        </div>
    </div>
</body>
</html>
