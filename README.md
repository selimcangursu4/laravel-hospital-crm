# laravel-hospital-crm
Laravel ile geliştirilmiş, hastane ve kliniklerin operasyonlarını daha verimli yönetmesini sağlayan modern bir CRM uygulaması. Hasta yönetimi, doktor planlaması, randevu sistemi, departman yönetimi ve bildirim modülleri gibi temel hastane süreçlerini tek bir panel üzerinden kolayca yönetmeye odaklanır.

📖 Proje Hakkında

Estetik hastaneleri için geliştirilmiş bu CRM sistemi, hasta süreçlerini uçtan uca yönetmek için tasarlanmıştır.
Sistem; hasta kaydı, randevu yönetimi, operasyon süreçleri, doktor/hasta iletişimi, satış süreçleri, kullanıcı rolleri ve detaylı yönetim paneli gibi modülleri destekler.

Modern geliştirme teknolojileri kullanılarak performanslı, güvenli ve MVC yapısına tamamen uygun şekilde inşa edilmiştir.

🧩 Kullanılan Teknolojiler

| Teknoloji               | Açıklama                                                    |
| ----------------------- | ----------------------------------------------------------- |
| **Laravel**             | Backend framework (MVC yapısı)                              |
| **Vite**                | Modern frontend asset bundler                               |
| **TailwindCSS v4**      | Hızlı ve optimize CSS framework                             |
| **Laravel Vite Plugin** | Laravel & Vite entegrasyonu                                 |
| **Axios**               | API istekleri için JS HTTP Client                           |
| **Concurrently**        | Geliştirme sırasında birden fazla script paralel çalıştırma |

✔ Net ayrılmış Controller – Service – Model yapısı
✔ Vue/React yoksa: Blade view + Tailwind uyumlu
✔ API endpoint’ler için ayrı api.php rotaları
✔ Modüler yapıya uygun genişletilebilir mimari

🚀 Kurulum
1️⃣ Repoyu klonla
git clone https://github.com/kullanici/estetik-hastane-crm.git
cd estetik-hastane-crm
2️⃣ Composer bağımlılıklarını yükle
composer install
3️⃣ .env dosyası oluştur
cp .env.example .env
php artisan key:generate
4️⃣ Veritabanı ayarlarını yap
.env içinde:
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...
5️⃣ Migration & Seeder
php artisan migrate --seed
6️⃣ Node bağımlılıklarını yükle
npm install
7️⃣ Geliştirme ortamını başlat
npm run dev
php artisan serve
🧠 Özellikler

✔ Hasta kayıt & takip sistemi
✔ Randevu planlama
✔ Operasyon & tedavi süreç yönetimi
✔ Doktor – hasta ilişkilendirme
✔ Satış ve danışman modülü
✔ Kullanıcı yetkilendirme (Role/Permission)
✔ Detaylı dashboard
✔ Bildirim & hatırlatma sistemi
✔ Modern, hızlı ve responsive arayüz

🛠 Build (Production)
npm run build
php artisan optimize
