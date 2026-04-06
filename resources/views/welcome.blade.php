<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PWF Pertemuan 3 - Role Based Access</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: sans-serif; background-color: #111; color: white; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #1a1a1a; padding: 40px; border-radius: 10px; border: 1px solid #333; text-align: center; width: 450px; }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="text-2xl font-bold mb-2">Nabiilah ‘Afiifah Zalfaa’ Safitri</h2>
        <p class="text-gray-400 mb-6">20230140243</p>

        <div class="flex flex-col gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white text-black py-2 px-4 rounded font-bold hover:bg-gray-200 transition">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-indigo-600 text-white py-2 px-4 rounded font-bold hover:bg-indigo-700 transition">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="border border-gray-600 text-white py-2 px-4 rounded font-bold hover:bg-gray-800 transition">Register</a>
                    @endif
                @endauth
            @endif
        </div>

        <div class="mt-8 pt-6 border-t border-gray-800">
            <p class="text-xs text-gray-500 italic">Pertemuan 3: Implementasi Gate & Policy</p>
        </div>
    </div>
</body>
</html>