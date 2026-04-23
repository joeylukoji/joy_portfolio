<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact &mdash; Joy Lukoji</title>
    <link rel="icon" type="image/webp" href="{{ asset('assets/img/joy.webp') }}">
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="prefetch" href="{{ route('portfolio') }}">
    <link rel="prefetch" href="{{ route('presentation') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
</head>

<body>
    <div class="grid-overlay"></div>

    <button id="themeToggle" title="Changer le th&egrave;me">
        <svg id="sunIcon" class="icon-hidden" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
        </svg>
        <svg id="moonIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
    </button>

    <div class="content-wrapper min-h-screen px-6 py-10 max-w-2xl mx-auto">

        <div class="mb-10 fade-in">
            <a href="{{ route('portfolio') }}" class="back-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M19 12H5M5 12L12 19M5 12L12 5"/>
                </svg> Retour au portfolio
            </a>
        </div>

        <div class="mb-10 fade-in d1">
            <p class="section-label">Me contacter</p>
            <h1 class="text-4xl font-bold tracking-tight mb-3">Travaillons ensemble</h1>
            <div class="divider"></div>
            <p class="text-gray-400 text-sm leading-relaxed">
                Un projet en t&ecirc;te ? Une question ? N'h&eacute;sitez pas &agrave; m'&eacute;crire, je r&eacute;ponds dans les meilleurs d&eacute;lais.
            </p>
        </div>

        <div class="card-glow p-6 mb-6 fade-in d2">
            <p class="section-label">Informations</p>
            <div class="contact-info-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <span>joymbiya60@email.com</span>
            </div>
            <div class="contact-info-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>
                <span>Lubumbashi, RD Congo</span>
            </div>
            <div class="contact-info-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10V6l-10-4L2 6v4l10 4 10-4z"/>
                    <path d="M6 12v5c0 2.21 2.69 4 6 4s6-1.79 6-4v-5"/>
                </svg>
                <span>Universit&eacute; Protestante de Lubumbashi &mdash; UPL</span>
            </div>
        </div>

        <div class="card-glow p-6 mb-10 fade-in d3">
            <p class="section-label">Formulaire</p>
            <form id="contactForm" action="{{ route('contact.store') }}" method="post" novalidate>
                @csrf
                @if ($errors->any())
                    <div class="text-red-300 text-sm mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1 flex flex-col gap-1">
                            <label class="text-xs text-gray-500 tracking-wide">Pr&eacute;nom &amp; Nom</label>
                            <input type="text" class="form-input" placeholder="Axel Kalongie" required id="inputName" name="prenom_nom" value="{{ old('prenom_nom') }}">
                        </div>
                        <div class="flex-1 flex flex-col gap-1">
                            <label class="text-xs text-gray-500 tracking-wide">Email</label>
                            <input type="email" class="form-input" placeholder="axelroads@email.com" required id="inputEmail" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs text-gray-500 tracking-wide">Sujet</label>
                        <input type="text" class="form-input" placeholder="Collaboration, question..." id="inputSubject" name="sujet" required value="{{ old('sujet') }}">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs text-gray-500 tracking-wide">Message</label>
                        <textarea class="form-input" placeholder="Votre message..." required id="inputMessage" name="message">{{ old('message') }}</textarea>
                    </div>
                    <div class="flex justify-end mt-2">
                        <button type="submit" class="submit-btn">
                            Envoyer le message
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @if (session('success'))
                    <div id="successMsg" style="display: block;">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>

        <div class="text-center text-gray-600 text-xs pb-6 fade-in d3">
            &copy; 2026 Joy Lukoji &mdash; Portfolio
        </div>

    </div>
    <script src="{{ asset('assets/javascript/contact.js') }}"></script>
</body>

</html>

