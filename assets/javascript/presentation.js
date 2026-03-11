function toggleTheme() {
    const body = document.body;
    const sun = document.getElementById('sunIcon');
    const moon = document.getElementById('moonIcon');
    const isLight = body.classList.toggle('light-mode');
    localStorage.setItem('theme', isLight ? 'light' : 'dark');
    sun.style.display = isLight ? 'block' : 'none';
    moon.style.display = isLight ? 'none' : 'block';
}

(function() {
    const saved = localStorage.getItem('theme');
    if (saved === 'light') {
        document.body.classList.add('light-mode');
        document.getElementById('sunIcon').style.display = 'block';
        document.getElementById('moonIcon').style.display = 'none';
    }
})();