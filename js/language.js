var currentLanguage = localStorage.getItem('language') || 'tr';

var translations = {
  'anasayfa': { tr: 'anasayfa', en: 'home' },
  'hakkımda': { tr: 'hakkımda', en: 'about' },
  'projeler/galeri': { tr: 'projeler/galeri', en: 'projects/gallery' },
  'projeler': { tr: 'projeler', en: 'projects' },
  'galeri': { tr: 'galeri', en: 'gallery' },
  'iletişim': { tr: 'iletişim', en: 'contact' },
  'lang-toggle': { tr: 'TR', en: 'EN' }
};

// Menü çevirisi
function applyMenuTranslations(lang) {
  $('[data-lang]').each(function() {
    var key = $(this).data('lang');
    if (translations[key]) {
      $(this).text(translations[key][lang]);
    }
  });
}

// İçerik (isteğe bağlı)
function applyLanguageToContent(lang) {
  $('[data-lang-tr][data-lang-en]').each(function() {
    var text = (lang === 'tr') ? $(this).data('lang-tr') : $(this).data('lang-en');

    if ($(this).is('input') || $(this).is('textarea')) {
      $(this).val(text);
    } else {
      $(this).text(text);
    }
  });
}

function changeLangToEnglish() {
  currentLanguage = 'en';
  localStorage.setItem('language', 'en');
  applyMenuTranslations('en');
  applyLanguageToContent('en');
}

function changeLangToTurkish() {
  currentLanguage = 'tr';
  localStorage.setItem('language', 'tr');
  applyMenuTranslations('tr');
  applyLanguageToContent('tr');
}

function setupLanguageToggle() {
  if ($('#langToggle').length === 0) return;
  $('#langToggle').off('click.langToggle');

  $('#langToggle').on('click.langToggle', function(e) {
    e.preventDefault();
    if (currentLanguage === 'tr') changeLangToEnglish();
    else changeLangToTurkish();
  });
}

function initializeLanguageSystem() {
  setupLanguageToggle();

  if (currentLanguage === 'en') {
    applyMenuTranslations('en');
    applyLanguageToContent('en');
  } else {
    applyMenuTranslations('tr');
    applyLanguageToContent('tr');
  }
}

$(document).ready(initializeLanguageSystem);
