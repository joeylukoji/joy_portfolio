<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joy Lukoji - Pr&eacute;sentation</title>
    <link rel="icon" type="image/webp" href="{{ asset('assets/img/joy.webp') }}">
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="prefetch" href="{{ route('portfolio') }}">
    <link rel="prefetch" href="{{ route('contact') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/presentation.css') }}">
</head>

<body>
    <div class="presentation-bg"></div>
    <div class="grid-overlay"></div>

    <button id="themeToggle" title="Changer le th&egrave;me">
        <svg id="sunIcon" class="icon-hidden" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
        </svg>
        <svg id="moonIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
    </button>

    <div class="content-wrapper min-h-screen px-6 py-10 max-w-3xl mx-auto">

        <div class="mb-10 fade-in flex justify-end">
            <a href="{{ route('portfolio') }}" class="back-btn">
                Aller au portfolio
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="flex flex-col items-center text-center mb-10 fade-in fade-in-delay-1">
            <div class="relative mb-6">
                <img src="{{ asset('assets/img/joy.webp') }}" alt="Joy Lukoji" class="profile-photo">
                <span class="absolute bottom-2 right-2 flex items-center justify-center w-5 h-5 bg-black rounded-full border border-white/20">
                    <span class="status-dot"></span>
                </span>
            </div>

            <p class="section-label">Pr&eacute;sentation</p>
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-3">Joy Lukoji</h1>
            <p class="text-gray-400 text-base mb-1">D&eacute;veloppeur Web Full-Stack</p>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg> Lubumbashi, RD Congo
            </div>

            <div class="divider"></div>

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 bg-white/5 text-sm text-gray-300 mb-2">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10V6l-10-4L2 6v4l10 4 10-4z"/>
                    <path d="M6 12v5c0 2.21 2.69 4 6 4s6-1.79 6-4v-5"/>
                </svg>
                <span>Universit&eacute; Protestante de Lubumbashi &mdash; <strong class="text-white">UPL</strong></span>
            </div>
            <p class="text-gray-500 text-xs">&Eacute;tudiant en Informatique</p>
        </div>

        <div class="card-glow p-6 mb-6 fade-in fade-in-delay-2">
            <p class="section-label">&Agrave; propos</p>
            <p class="text-gray-300 leading-relaxed text-sm">
                Passionn&eacute; par le d&eacute;veloppement web, je suis &eacute;tudiant &agrave; l'Universit&eacute; Protestante de Lubumbashi (UPL). Je con&ccedil;ois des applications web modernes, performantes et accessibles, aussi bien c&ocirc;t&eacute; client que c&ocirc;t&eacute; serveur. Mon objectif est de cr&eacute;er des exp&eacute;riences
                digitales qui allient esth&eacute;tique et fonctionnalit&eacute;.
            </p>
        </div>

        <div class="card-glow p-6 mb-6 fade-in fade-in-delay-3">
            <p class="section-label">Frontend</p>
            <div class="flex flex-wrap gap-2 mt-1">
                <span class="tech-tag frontend">
                    <svg class="mr-2" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                    JavaScript
                </span>
                <span class="tech-tag frontend">
                    <svg class="mr-2" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="4"/><line x1="12" y1="20" x2="12" y2="22"/><line x1="2" y1="12" x2="4" y2="12"/><line x1="20" y1="12" x2="22" y2="12"/></svg>
                    React JS
                </span>
                <span class="tech-tag frontend">
                    <svg class="mr-2" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                     Tailwind CSS
                </span>
                <span class="tech-tag frontend">
                    <svg class="mr-2" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 7 4 4 20 4 20 7"/><line x1="9" y1="20" x2="15" y2="20"/><line x1="12" y1="4" x2="12" y2="20"/></svg>
                    HTML / CSS
                </span>
            </div>
        </div>

        <div class="card-glow p-6 mb-10 fade-in fade-in-delay-4">
            <p class="section-label">Backend</p>
            <div class="flex flex-wrap gap-2 mt-1">
                <span class="tech-tag backend">
                    <svg class="mr-2" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    Python
                </span>
                <span class="tech-tag backend">Django</span>
                <span class="tech-tag backend">FastAPI</span>
                <span class="tech-tag backend">Flask</span>
                <span class="tech-tag tech-tag-accent">
                    PHP (notions)
                </span>
            </div>
        </div>

        <div class="text-center text-gray-600 text-xs pb-6 fade-in fade-in-delay-4">
            &copy; 2026 Joy Lukoji &mdash; Portfolio
        </div>

    </div>
    <script src="{{ asset('assets/javascript/presentation.js') }}"></script>
</body>

</html>
