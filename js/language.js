// Dil sistemi (daha güvenli, setupLanguageToggle global fonksiyon sağlar)
var currentLanguage = localStorage.getItem('language') || 'tr';

// Çeviriler (menü anahtarları)
var translations = {
  'anasayfa': { tr: 'anasayfa', en: 'home' },
  'hakkımda': { tr: 'hakkımda', en: 'about' },
  'projeler/galeri': { tr: 'projeler/galeri', en: 'projects/gallery' },
  'projeler': { tr: 'projeler', en: 'projects' },
  'galeri': { tr: 'galeri', en: 'gallery' },
  'iletişim': { tr: 'iletişim', en: 'contact' },
  'lang-toggle': { tr: 'TR', en: 'EN' }
};

// Genel: içerik çevirisi (data-lang-tr / data-lang-en kullanan öğeler)
function applyLanguageToContent(lang) {
  $('[data-lang-tr][data-lang-en]').each(function() {
    var text = (lang === 'tr') ? $(this).data('lang-tr') : $(this).data('lang-en');
    // textarea'lar veya inputlar için val(), diğerleri için text()
    if ($(this).is('input') || $(this).is('textarea')) {
      $(this).val(text);
    } else {
      $(this).text(text);
    }
  });
}

// Menü çevirisi
function applyMenuTranslations(lang) {
  $('[data-lang]').each(function() {
    var key = $(this).data('lang');
    if (translations[key]) {
      $(this).text(translations[key][lang]);
    }
  });
}

// İngilizceye çevir
function changeLangToEnglish() {
  currentLanguage = 'en';
  localStorage.setItem('language', 'en');
  applyMenuTranslations('en');
  applyLanguageToContent('en');
}

// Türkçeye çevir
function changeLangToTurkish() {
  currentLanguage = 'tr';
  localStorage.setItem('language', 'tr');
  applyMenuTranslations('tr');
  applyLanguageToContent('tr');
}

// setupLanguageToggle: global, güvenli, idempotent
function setupLanguageToggle() {
  // Eğer buton yoksa çık
  if (typeof jQuery === 'undefined') return;
  if ($('#langToggle').length === 0) return;

  // Önce mevcut handler'ı kaldır (tekrarı önlemek için)
  $('#langToggle').off('.langToggle');

  // Butona tıklama handler'ı
  $('#langToggle').on('click.langToggle', function(e) {
    e.preventDefault();
    if (currentLanguage === 'tr') changeLangToEnglish(); else changeLangToTurkish();
  });

  // Sayfa yüklendiğinde mevcut dili uygula
  if (currentLanguage === 'en') {
    applyMenuTranslations('en');
    applyLanguageToContent('en');
  } else {
    applyMenuTranslations('tr');
    applyLanguageToContent('tr');
  }
}

// Doküman hazır olduğunda otomatik kurulum (aynı fonksiyonu tekrar çağırmak güvenlidir)
if (typeof jQuery !== 'undefined') {
  jQuery(function() {
    // setupLanguageToggle fonksiyonunu çağır (inline çağrılar artık güvenli)
    setupLanguageToggle();
  });
}
