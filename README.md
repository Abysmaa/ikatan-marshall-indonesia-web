# Ikatan Marshall Indonesia

Website company profile IMI dengan konten publik dinamis, panel admin, dan alur permintaan dukungan marshal.

## Teknologi

- Laravel 13
- Filament 5
- PHP 8.3+
- SQLite untuk pengembangan lokal; MySQL atau PostgreSQL direkomendasikan untuk produksi
- Blade, CSS, dan JavaScript untuk frontend

Node.js tidak diperlukan untuk menjalankan frontend saat ini. Aplikasi Laravel ada di folder `imi-marshall`; file `index.html` di folder workspace induk adalah prototipe statis.

## Setup Lokal

### Windows PowerShell

Jalankan perintah dari folder workspace:

```powershell
Set-Location .\imi-marshall
composer install
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite | Out-Null }
```

Pada instalasi baru, buat application key:

```powershell
php artisan key:generate
```

Jangan jalankan ulang perintah ini setelah aplikasi memiliki key yang digunakan.

Isi nilai berikut di `.env` lokal untuk membuat akun admin. Jangan commit nilai nyata atau mengirim password melalui chat:

```dotenv
IMI_ADMIN_NAME="Nama Admin"
IMI_ADMIN_EMAIL=admin@example.com
IMI_ADMIN_PASSWORD="password-kuat-unik"
```

Lalu siapkan database dan jalankan server:

```powershell
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Buka `http://127.0.0.1:8000`. Panel admin ada di `http://127.0.0.1:8000/admin`.

### macOS / Linux

```bash
cd imi-marshall
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
```

Isi `IMI_ADMIN_NAME`, `IMI_ADMIN_EMAIL`, dan `IMI_ADMIN_PASSWORD` di `.env`, lalu jalankan:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Seeder membuat admin hanya jika ketiga `IMI_ADMIN_*` terisi. Untuk memperbarui akun admin yang sudah ada menggunakan konfigurasi `.env` saat ini, jalankan `php artisan db:seed --class=AdminUserSeeder`. Password otomatis di-hash oleh Laravel.

## Fitur Publik

- Homepage, profil IMI, layanan, coverage, perlengkapan, event, galeri, dan kontak.
- Hanya record berstatus aktif yang tampil. Event, partner, dan galeri sengaja tidak diberi data fiktif.
- Detail layanan, perlengkapan, dan event menggunakan URL slug.
- Sitemap dinamis, `robots.txt`, metadata dasar, dan layout responsif.
- Form kontak menyimpan lead setelah pengunjung memberi persetujuan. Jika nomor WhatsApp diatur, pesan juga diteruskan ke WhatsApp.

## Panel Admin

Akses `/admin` dengan user ber-role `admin`. Registrasi publik tidak tersedia.

| Menu | Pengelolaan |
| --- | --- |
| Layanan | Peran marshal dan timing system. |
| Area Layanan | Area coverage dan koordinat. |
| Perlengkapan | Deskripsi, jumlah, ketersediaan, dan foto. |
| Event Didukung | Informasi dan dokumentasi event terverifikasi. |
| Partner | Informasi dan logo partner/client. |
| Galeri | Foto dokumentasi, termasuk relasi ke event. |
| Pengaturan | Teks homepage dan informasi kontak. |
| Pesan Masuk | Lead kontak dan status tindak lanjut. |

Status lead: `Baru`, `Ditindaklanjuti`, dan `Selesai`. Pesan diurutkan terbaru dan inbox hanya dapat diakses admin.

## Lead dan Privasi

Form kontak memvalidasi nama, email, telepon, event, pesan, dan persetujuan penyimpanan. Data disimpan di tabel `contact_messages` dengan waktu persetujuan. Endpoint dibatasi sampai lima kiriman per menit dan memakai honeypot sederhana untuk spam.

Nomor WhatsApp IMI dikelola pada menu Pengaturan dengan key `contact_whatsapp`, dalam format internasional tanpa `+`, contoh `6281234567890`. Tanpa nomor tersebut, pesan tetap tersimpan dan pengunjung melihat konfirmasi tindak lanjut.

Tentukan masa retensi dan prosedur penghapusan data kontak sebelum produksi. Batasi akses admin dan siapkan backup sesuai kebijakan privasi IMI.

## Data Awal

`php artisan migrate --seed` mengisi sembilan layanan termasuk timing system, enam area coverage, enam jenis perlengkapan, dan teks dasar homepage. Seeder dapat dijalankan ulang.

Data event, partner, galeri, nomor kontak, serta foto resmi perlu dimasukkan setelah diverifikasi oleh IMI. Pastikan ada izin publikasi untuk semua nama, logo, dan foto. Ketersediaan perlengkapan awal masih perlu dikonfirmasi oleh tim.

## Route Publik

| Method | URL | Fungsi |
| --- | --- | --- |
| GET | `/` | Homepage. |
| GET | `/about` | Profil IMI. |
| GET | `/services` | Daftar layanan. |
| GET | `/services/{slug}` | Detail layanan aktif. |
| GET | `/equipment` | Daftar perlengkapan. |
| GET | `/equipment/{slug}` | Detail perlengkapan aktif. |
| GET | `/events` | Event yang dipublikasikan. |
| GET | `/events/{slug}` | Detail event aktif. |
| GET | `/gallery` | Galeri dokumentasi. |
| GET / POST | `/contact` | Form kontak dan pengiriman lead. |
| GET | `/sitemap.xml` | Sitemap halaman publik dan record aktif. |
| GET | `/robots.txt` | Instruksi crawler; `/admin` dikecualikan. |
| GET | `/admin` | Panel Filament, wajib login admin. |

## Database

Tabel aplikasi meliputi `users`, `services`, `coverage_areas`, `equipment`, `events`, `partners`, `galleries`, `settings`, dan `contact_messages`. Galeri dapat terhubung ke event; menghapus event akan melepas relasi galeri, bukan menghapus fotonya.

File yang diunggah admin menerima JPEG, PNG, atau WebP dengan ukuran maksimal 5 MB. File publik disimpan pada disk `public`; `php artisan storage:link` membuatnya dapat diakses melalui web.

## Perintah Pengembangan

Jalankan dari folder `imi-marshall`:

```bash
php artisan test
vendor/bin/pint --test
php artisan migrate:status
php artisan route:list
```

Rapikan source PHP dengan `vendor/bin/pint`.

## Struktur Utama

```text
app/Http/Controllers/       Controller homepage, publik, kontak, sitemap
app/Models/                 Model konten dan lead kontak
app/Filament/               CRUD admin dan widget dashboard
database/migrations/         Skema database
database/seeders/            Konten awal dan admin opsional
resources/views/             Layout dan halaman Blade
public/styles.css            Gaya homepage
public/pages.css             Gaya halaman dalam
public/script.js             Navigasi mobile
```

## Checklist Produksi

- Atur `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` HTTPS, dan cookie sesi secure pada environment server.
- Gunakan database terkelola; jangan deploy `database/database.sqlite` dari komputer lokal.
- Buat `APP_KEY` satu kali dan simpan semua secret hanya di environment server/secret manager.
- Jalankan `php artisan migrate --force` setelah konfigurasi database benar.
- Pastikan penyimpanan publik, backup database dan uploads, email/WhatsApp, serta kebijakan retensi lead telah dikonfigurasi.
- Uji login admin, CRUD, upload, form kontak, sitemap, link, tampilan mobile, dan pemulihan backup di staging sebelum rilis.

Jangan commit `.env`, database lokal, data lead, secret, atau file upload privat. Hanya masukkan aset yang disetujui untuk publikasi ke Git.
