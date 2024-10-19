<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Flowbite CDN -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        body {
            position: relative;
            background: url('/images/ready-back-school.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
            z-index: 1;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            width: 900px;
            max-width: 100%;
            z-index: 2; /* Make sure the container is above the overlay */
        }

        .left-section {
            background-color: #057A55;
            color: white;
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-section {
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .right-section form {
            max-width: 300px;
            width: 100%;
        }

        .logo img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <h3 class="text-3xl font-bold">Welcome to Learning Management System</h3>
            <p class="mt-4 text-sm text-white-300">Our Learning Management System revolutionizes your educational environment by providing a robust set of tools for course management, assignment tracking, and student engagement. With intuitive dashboards and in-depth analytics, you can easily manage courses, monitor student progress, and enhance the learning experience. Join us in transforming your institution into a modern, efficient, and interactive learning hub.</p>
            
            <div class="mt-4">
                <p class="text-xs text-gray-100">- Made by Tahrima, Kanij, Jinia</p>
            </div>
        </div>
        <div class="right-section">
            <div class="logo mb-8">
                <img src="/images/light-bulb.png" alt="Logo">
            </div>
            <h2 class="text-2xl font-semibold mb-4 text-center">Sign in</h2>
            <form action="{{ route('login') }}" method="POST">
            @csrf
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <div class="text-sm mb-5 text-red-500">
                            {{ \Illuminate\Support\Facades\Session::get('error') }}
                        </div>
                    @endif

                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="text-sm mb-5 text-green-500">
                            {{ \Illuminate\Support\Facades\Session::get('success') }}
                        </div>
                    @endif
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email*</label>
                    <input type="text" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password*</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" required>
                </div>
                <div>
                    <button type="submit" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>
            <div class="mt-10 text-center">
                <p class="text-xs text-gray-400">Web App Version: 1.0.0</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
