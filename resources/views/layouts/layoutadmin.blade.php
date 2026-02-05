<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Opdrachten</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.12/dist/tailwind.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #0f172a;
            --card: #0b1224;
            --accent: #a78bfa;
            --soft: #e2e8f0;
        }

        body {
            font-family: 'Space Grotesk', 'Segoe UI', sans-serif;
            background: radial-gradient(circle at 15% 20%, rgba(167, 139, 250, 0.12), transparent 25%),
                radial-gradient(circle at 80% 10%, rgba(56, 189, 248, 0.12), transparent 20%),
                linear-gradient(180deg, #f8fafc 0%, #eef2ff 35%, #f8fafc 100%);
            color: var(--ink);
        }
    </style>
</head>

<body class="min-h-screen">
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-[260px,1fr]">
        <aside class="bg-slate-900 text-slate-100 flex flex-col border-r border-slate-800">
            <div class="flex items-center justify-between px-6 py-6 border-b border-slate-800">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Admin</p>
                    <p class="text-lg font-semibold">Laravel Opdrachten</p>
                </div>
                <span class="text-sm px-3 py-1 rounded-full bg-slate-800 text-slate-200">v1</span>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-800/70 text-slate-100 hover:bg-slate-800 transition" href="/admin">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    <span>Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800 transition" href="{{ route('projects.index') }}">
                    <span class="h-2 w-2 rounded-full bg-sky-400"></span>
                    <span>Projecten</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800 transition" href="{{ route('tasks.index') }}">
                    <span class="h-2 w-2 rounded-full bg-amber-300"></span>
                    <span>Taken</span>
                </a>
                @guest
                <div class="pt-4 mt-4 border-t border-slate-800/60">
                    <p class="px-4 text-[11px] uppercase tracking-[0.2em] text-slate-500 mb-2">Account</p>
                    <a class="block px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800 transition" href="{{ route('login') }}">Login</a>
                    @if(Route::has('register'))
                    <a class="block px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800 transition" href="{{ route('register') }}">Register</a>
                    @endif
                </div>
                @endguest
            </nav>
            <div class="px-6 py-5 border-t border-slate-800/60">
                <p class="text-xs text-slate-400">Snelle links</p>
                <div class="mt-3 space-y-2 text-sm text-slate-200">
                    <a class="block hover:text-white" href="/">Publieke site</a>
                    <a class="block hover:text-white" href="{{ route('dashboard') }}">Dashboard</a>
                </div>
            </div>
        </aside>

        <div class="flex flex-col bg-white/70 backdrop-blur">
            <header class="sticky top-0 z-10 bg-white/80 backdrop-blur border-b border-slate-200/70">
                <div class="flex items-center justify-between px-6 py-4 lg:px-10">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Laravel Opdrachten</p>
                        <h1 class="text-2xl font-semibold text-slate-900">Admin layout</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <a class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full border border-slate-200 bg-white text-sm text-slate-900 hover:border-slate-300 hover:text-slate-950 transition" href="{{ route('projects.create') }}">
                            <span class="h-2 w-2 rounded-full bg-indigo-400"></span>
                            Nieuw project
                        </a>
                        <div class="hidden md:flex items-center gap-2 px-3 py-2 rounded-full bg-slate-100 text-sm text-slate-700">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            Live
                        </div>
                        @auth
                        <div class="flex items-center gap-3 px-3 py-2 rounded-full border border-slate-200 bg-white shadow-sm">
                            <div class="h-9 w-9 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                            <div class="leading-tight">
                                <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500">Ingelogd</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-4 py-2 rounded-full bg-slate-900 text-white text-sm hover:bg-slate-800 transition" type="submit">Uitloggen</button>
                        </form>
                        @endauth
                        @guest
                        <a class="px-4 py-2 rounded-full bg-slate-900 text-white text-sm hover:bg-slate-800 transition" href="{{ route('login') }}">Login</a>
                        @endguest
                    </div>
                </div>
            </header>

            <main class="flex-1 px-6 py-8 lg:px-10 lg:py-12 space-y-6">
                <section class="grid gap-6 lg:grid-cols-[2fr,1fr] items-start">
                    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-8">
                        <div class="flex flex-col gap-3">
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Welkom</p>
                            <h2 class="text-3xl font-semibold text-slate-900">Laravel Opdrachten</h2>
                            <p class="text-slate-600 leading-relaxed">Een lichte Tailwind admin basis waarop je eigen content kan landen. Gebruik de navigatie links om projecten of taken te beheren.</p>
                        </div>
                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Projecten</p>
                                <p class="text-2xl font-semibold text-slate-900">{{ \App\Models\Project::count() }}</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Taken</p>
                                <p class="text-2xl font-semibold text-slate-900">{{ \App\Models\Task::count() }}</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Gebruikers</p>
                                <p class="text-2xl font-semibold text-slate-900">{{ \App\Models\User::count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-slate-900">Snelle acties</p>
                            <span class="text-xs px-3 py-1 rounded-full bg-indigo-100 text-indigo-700">Tailwind</span>
                        </div>
                        <div class="grid gap-3">
                            <a class="flex items-center justify-between px-4 py-3 rounded-2xl border border-slate-200 hover:border-slate-300 transition" href="{{ route('projects.create') }}">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Nieuw project</p>
                                    <p class="text-xs text-slate-500">Start een project</p>
                                </div>
                                <span class="h-8 w-8 flex items-center justify-center rounded-full bg-slate-900 text-white">+</span>
                            </a>
                            <a class="flex items-center justify-between px-4 py-3 rounded-2xl border border-slate-200 hover:border-slate-300 transition" href="{{ route('tasks.create') }}">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Nieuwe taak</p>
                                    <p class="text-xs text-slate-500">Koppel aan een project</p>
                                </div>
                                <span class="h-8 w-8 flex items-center justify-center rounded-full bg-slate-900 text-white">+</span>
                            </a>
                        </div>
                    </div>
                </section>

                @yield('topmenu')

                <section class="rounded-3xl border border-slate-200 bg-white shadow-sm p-8">
                    @yield('content')
                </section>
            </main>
        </div>
    </div>
</body>

</html>