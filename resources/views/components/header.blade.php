<header class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light container">
    <!-- Логотип -->
    <a class="navbar-brand" href="#">
      <img src="https://via.placeholder.com/100x40?text=Logo" alt="Логотип" height="40" />
    </a>
    <!-- Кнопка для мобильных -->
    <button 
      class="navbar-toggler" 
      type="button" 
      aria-controls="navbarLang" 
      aria-expanded="false" 
      aria-label="Toggle navigation"
      id="navbar-toggler"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Выбор языка -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarLang">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('set-locale', 'ru') }}">Русский</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('set-locale', 'en') }}">English</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('set-locale', 'ua') }}">Deutsch</a></li>
      </ul>
    </div>
  </nav>
</header>
<script>
  // Чистый JS для работы кнопки-бургера
  document.getElementById('navbar-toggler').addEventListener('click', function() {
    const menu = document.getElementById('navbarLang');
    const expanded = this.getAttribute('aria-expanded') === 'true';
    if (expanded) {
      menu.classList.remove('show');
      this.setAttribute('aria-expanded', 'false');
    } else {
      menu.classList.add('show');
      this.setAttribute('aria-expanded', 'true');
    }
  });
</script>