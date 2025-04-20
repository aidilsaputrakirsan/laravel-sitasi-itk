## Tantangan dan Solusi

| Tantangan | Solusi Implementasi |
|-----------|---------------------|
| **Kompleksitas Alur Kerja** | Menggunakan state management yang jelas dalam sistem untuk tracking status di setiap tahap |
| **Manajemen Notifikasi** | Implementasi sistem notifikasi real-time dengan menggunakan model Notifikasi terpusat |
| **Integrasi Multi-Peran** | Menggunakan Spatie Permission untuk manajemen hak akses granular |
| **Dokumen yang Kompleks** | Pembuatan service class khusus (PdfService) untuk standardisasi format dokumen |
| **Konsistensi Data** | Penggunaan fitur validasi Laravel dan Livewire untuk menjamin kualitas data |
| **Performa** | Menggunakan Livewire untuk mencapai responsivitas aplikasi tanpa beban penuh SPA |
| **Keamanan Dokumen** | Implementasi validasi file upload dan manajemen permission untuk akses dokumen |

## Rencana Pengembangan

- [ ] Integrasi dengan sistem akademik kampus
- [ ] Implementasi dashboard analitik
- [ ] Pengembangan aplikasi mobile
- [ ] Fitur plagiarism checker
- [ ] Sistem repositori tugas akhir terintegrasi
- [ ] Calendar view untuk jadwal sempro dan sidang
- [ ] API untuk integrasi dengan sistem lain## Manfaat dan Dampak

### Bagi Mahasiswa
- Memudahkan proses pengajuan judul dan monitoring status
- Transparansi dalam proses bimbingan dan penilaian
- Akses ke informasi penting (jadwal, nilai, status revisi)
- Kemudahan dokumentasi hasil bimbingan

### Bagi Dosen
- Pengelolaan bimbingan lebih terstruktur
- Notifikasi pengajuan dan pengumpulan
- Koordinasi jadwal yang terintegrasi
- Penilaian yang terstruktur dan transparan

### Bagi Tenaga Kependidikan
- Otomatisasi proses administratif
- Pencatatan yang terstandarisasi
- Pengurangan beban kerja manual
- Pembuatan laporan dan dokumen yang efisien

### Bagi Program Studi
- Data dan statistik pelaksanaan tugas akhir
- Peningkatan kualitas pengelolaan tugas akhir
- Standardisasi proses di seluruh program studi
- Penghematan sumber daya (waktu, kertas, ruang penyimpanan)## Alur Kerja Sistem

### 1. Alur Pengajuan Tugas Akhir

```
┌───────────────┐     ┌────────────────┐     ┌────────────────┐     ┌────────────────┐
│   Mahasiswa   │     │    Sistem      │     │  Pembimbing 1  │     │  Pembimbing 2  │
└───────┬───────┘     └────────┬───────┘     └────────┬───────┘     └────────┬───────┘
        │                      │                      │                      │
        │  Mengajukan Judul    │                      │                      │
        │─────────────────────>│                      │                      │
        │                      │                      │                      │
        │                      │   Notifikasi Judul   │                      │
        │                      │─────────────────────>│                      │
        │                      │                      │                      │
        │                      │   Notifikasi Judul   │                      │
        │                      │─────────────────────────────────────────────>
        │                      │                      │                      │
        │                      │                      │    Setuju/Tolak      │
        │                      │<─────────────────────│                      │
        │                      │                      │                      │
        │                      │                      │                      │    Setuju/Tolak
        │                      │<─────────────────────────────────────────────
        │                      │                      │                      │
        │  Notifikasi Status   │                      │                      │
        │<─────────────────────│                      │                      │
        │                      │                      │                      │
```

### 2. Alur Bimbingan

```
┌───────────────┐     ┌────────────────┐     ┌────────────────┐
│   Mahasiswa   │     │    Sistem      │     │     Dosen      │
└───────┬───────┘     └────────┬───────┘     └────────┬───────┘
        │                      │                      │
        │  Input Bimbingan     │                      │
        │─────────────────────>│                      │
        │                      │                      │
        │                      │  Notifikasi Bimbingan│
        │                      │─────────────────────>│
        │                      │                      │
        │                      │                      │ Setuju/Revisi
        │                      │<─────────────────────│
        │                      │                      │
        │  Notifikasi Status   │                      │
        │<─────────────────────│                      │
        │                      │                      │
```

### 3. Alur Seminar Proposal (Sempro)

```
┌───────────┐    ┌────────┐    ┌───────────┐    ┌──────────┐    ┌─────────┐
│ Mahasiswa │    │ Sistem │    │  Tendik   │    │  Koorpro │    │ Penguji │
└─────┬─────┘    └────┬───┘    └─────┬─────┘    └────┬─────┘    └────┬────┘
      │               │              │               │               │
      │  Daftar       │              │               │               │
      │───────────────>              │               │               │
      │               │              │               │               │
      │               │ Notifikasi   │               │               │
      │               │──────────────>               │               │
      │               │              │               │               │
      │               │              │ Verifikasi    │               │
      │               │<─────────────│               │               │
      │               │              │               │               │
      │               │              │ Jadwalkan     │               │
      │               │              │───────────────>               │
      │               │              │               │               │
      │               │              │               │ Tentukan      │
      │               │              │               │ Penguji       │
      │               │              │               │───────────────>
      │               │              │               │               │
      │               │              │               │               │
      │ Pelaksanaan   │              │               │               │
      │◄──────────────┼──────────────┼───────────────┼───────────────┤
      │ Seminar       │              │               │               │
      │               │              │               │               │
      │ Revisi        │              │               │               │
      │◄──────────────┼──────────────┼───────────────┼───────────────┤
      │ Seminar       │              │               │               │
      │               │              │               │               │
```

### 4. Alur Sidang Tugas Akhir
Serupa dengan alur Seminar Proposal, dengan fokus pada tahap akhir dari tugas akhir mahasiswa.## Fitur Utama

- **Manajemen Pengguna**: 
  - Pembagian peran (Mahasiswa, Dosen, Tendik, Koorpro) dengan hak akses berbeda
  - Manajemen profil pengguna dengan tanda tangan digital
  - Import data pengguna via Excel

- **Pengajuan Tugas Akhir**: 
  - Pengajuan judul dan bidang penelitian
  - Pemilihan dosen pembimbing
  - Persetujuan/penolakan judul dengan alasan
  - Tracking status pengajuan

- **Bimbingan**: 
  - Pencatatan hasil bimbingan dengan dosen
  - Persetujuan hasil bimbingan oleh dosen
  - Laporan bimbingan dalam format PDF (Form TA-006)

- **Seminar Proposal**: 
  - Pendaftaran dengan upload berkas persyaratan
  - Verifikasi berkas oleh Tendik
  - Penjadwalan dan penentuan penguji
  - Penilaian dari 4 dosen (2 pembimbing, 2 penguji)
  - Revisi dan persetujuan revisi

- **Sidang Tugas Akhir**: 
  - Pendaftaran dengan upload draft final
  - Verifikasi berkas oleh Tendik
  - Penjadwalan sidang
  - Penilaian komprehensif
  - Revisi dan persetujuan revisi

- **Katalog & Referensi**: 
  - Repositori tugas akhir yang sudah selesai
  - Bank judul referensi dari dosen

- **Dokumen Otomatis**: 
  - Pembuatan berbagai formulir dan dokumen dalam format PDF
  - Berita acara seminar dan sidang

- **Notifikasi**: 
  - Sistem notifikasi real-time untuk aktivitas penting
  - Riwayat aktivitas yang terstruktur## Screenshot Aplikasi

![Dashboard](path/to/dashboard.jpg)
![Form Pengajuan](path/to/form-pengajuan.jpg)
![Daftar Bimbingan](path/to/bimbingan.jpg)
![Jadwal Sempro](path/to/jadwal.jpg)# SITASI-ITK (Sistem Informasi Tugas Akhir ITK)

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![Livewire](https://img.shields.io/badge/Livewire-3.x-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-purple.svg)
![SoftUI](https://img.shields.io/badge/SoftUI-Dashboard-green.svg)
![License](https://img.shields.io/badge/license-MIT-blue.svg)

## Tentang SITASI-ITK

SITASI-ITK adalah sistem informasi manajemen tugas akhir yang memfasilitasi seluruh proses penyelesaian tugas akhir mahasiswa, mulai dari pengajuan judul, bimbingan, seminar proposal, hingga sidang tugas akhir. Sistem ini dibangun menggunakan Laravel 10.x sebagai backend dan Soft UI Dashboard sebagai template frontend dengan Livewire 3.x untuk interaktivitas.

## Latar Belakang

Pengelolaan tugas akhir di perguruan tinggi sering kali melibatkan banyak proses administratif yang membutuhkan koordinasi antara mahasiswa, dosen pembimbing, penguji, dan tenaga kependidikan. Sistem tradisional yang berbasis kertas memunculkan berbagai tantangan:

- Sulitnya melacak progres mahasiswa
- Proses dokumentasi yang tidak terstandar
- Kesulitan dalam penjadwalan
- Kurangnya transparansi dan akses informasi

SITASI-ITK dikembangkan untuk menyelesaikan permasalahan tersebut dengan menghadirkan platform terintegrasi yang mendigitalisasi dan mengotomatisasi proses manajemen tugas akhir, meningkatkan efisiensi dan transparansi bagi seluruh pemangku kepentingan.

## Keunggulan Sistem

1. **Terpadu**: Mengelola seluruh proses dari pengajuan judul hingga sidang tugas akhir dalam satu platform
2. **Real-time**: Notifikasi otomatis untuk setiap aktivitas penting
3. **Paperless**: Mengurangi penggunaan kertas dengan digitalisasi formulir dan dokumen
4. **Terstruktur**: Alur kerja yang jelas dengan tahapan yang terorganisir
5. **Transparan**: Tracking status dan progres yang mudah diakses
6. **Terintegrasi**: Pembuatan dokumen otomatis sesuai standar institusi

### Teknologi yang Digunakan

- **Backend**: Laravel 10.x framework PHP
  - Spatie Permission untuk manajemen role dan permission
  - DomPDF untuk generasi dokumen PDF
  - Laravel Excel untuk import/export data
  - AWS S3 untuk penyimpanan dokumen (opsional)
- **Frontend**: 
  - Soft UI Dashboard untuk template UI
  - Livewire 3.x untuk komponen interaktif tanpa full-page reload
  - Alpine.js untuk interaktivitas UI
  - Bootstrap 5 untuk layout dan komponen
- **Database**: MySQL 5.7+ untuk penyimpanan data
- **Deployment**: Dapat di-deploy di server Apache/Nginx

## Prasyarat

Untuk menjalankan aplikasi ini, Anda memerlukan:

- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 5.7 atau lebih tinggi
- Node.js dan NPM (untuk asset compilation)
- Web server (Apache/Nginx)

Petunjuk pengaturan lingkungan lokal:
- Windows: [Panduan untuk Windows](https://updivision.com/blog/post/beginner-s-guide-to-setting-up-your-local-development-environment-on-windows)
- Linux & Mac: [Panduan untuk Linux & Mac](https://updivision.com/blog/post/guide-what-is-lamp-and-how-to-install-it-on-ubuntu-and-macos)

## Instalasi

1. Clone repositori:
   ```bash
   git clone https://github.com/yourusername/sitasi-itk.git
   ```

2. Pindah ke direktori proyek:
   ```bash
   cd sitasi-itk
   ```

3. Instal dependensi PHP:
   ```bash
   composer install
   ```

4. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi (terutama database):
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Migrasikan dan isi database:
   ```bash
   php artisan migrate --seed
   ```

7. Buat symbolic link untuk storage:
   ```bash
   php artisan storage:link
   ```

8. Kompilasi aset frontend (opsional):
   ```bash
   npm install && npm run dev
   ```

9. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## Penggunaan

Masuk ke sistem menggunakan kredensial default atau daftar sebagai pengguna baru:

- **Admin/Tendik**: tendik@example.com / 12345678
- **Dosen**: dosen@example.com / 12345678
- **Koordinator Program**: koorpro@example.com / 12345678
- **Mahasiswa**: mahasiswa@example.com / 12345678

## Arsitektur Sistem

```
┌───────────────────┐     ┌───────────────────┐     ┌───────────────────┐
│   Presentation    │     │     Business      │     │       Data        │
│      Layer        │────▶│      Layer        │────▶│      Layer        │
└───────────────────┘     └───────────────────┘     └───────────────────┘
        │                          │                          │
        ▼                          ▼                          ▼
┌───────────────────┐     ┌───────────────────┐     ┌───────────────────┐
│   Blade Views     │     │    Controllers    │     │      Models       │
│   Livewire Comp.  │     │    Services       │     │    Repositories   │
│   UI Components   │     │    Validators     │     │    Migrations     │
└───────────────────┘     └───────────────────┘     └───────────────────┘
```

SITASI-ITK mengimplementasikan arsitektur MVC (Model-View-Controller) yang diperluas dengan komponen Livewire untuk pengalaman pengguna yang dinamis:

1. **Presentation Layer**: Menangani UI/UX menggunakan Blade templates dan Livewire components dengan Soft UI Dashboard
2. **Business Layer**: Logika bisnis dalam Controllers dan Services yang memproses request dan menghasilkan response
3. **Data Layer**: Model Eloquent dan migrasi yang berinteraksi dengan database

Komunikasi antara klien dan server memanfaatkan kemampuan Livewire untuk meminimalkan refresh halaman penuh dan memberikan pengalaman seperti aplikasi SPA (Single Page Application).

## Struktur Database

### Diagram Entity Relationship

```
┌───────────────┐       ┌───────────────┐       ┌───────────────┐
│     users     │       │   mahasiswas  │       │    dosens     │
├───────────────┤       ├───────────────┤       ├───────────────┤
│ id            │       │ id            │       │ id            │
│ name          │       │ nama          │       │ nama_dosen    │
│ email         │       │ nim           │       │ nip           │
│ username      │       │ email         │       │ email         │
│ password      │       │ nomor_telepon │       │ user_id       │
│ signature     │       │ user_id       │       └───────┬───────┘
└──────┬────────┘       └───────┬───────┘               │
       │                        │                        │
       │                        │                        │
┌──────┴────────┐       ┌──────┴────────┐       ┌───────┴───────┐
│  pengajuan_ta │◄──────┤  bimbingans   │       │ penilaian     │
├───────────────┤       ├───────────────┤       ├───────────────┤
│ id            │       │ id            │       │ id            │
│ judul         │       │ tanggal       │       │ sempro_id/    │
│ mahasiswa_id  │       │ user_id       │       │ sidang_ta_id  │
│ pembimbing_1  │───────┤ dosen         │       │ user_id       │
│ pembimbing_2  │       │ ket_bimbingan │       │ media_present │
│ status        │       │ hasil_bimbingan│      │ komunikasi    │
└──────┬────────┘       │ status        │       │ dll.          │
       │                └───────────────┘       └───────────────┘
       │
┌──────┴────────┐       ┌───────────────┐       ┌───────────────┐
│    sempros    │       │   periodes    │       │  jadwal       │
├───────────────┤       ├───────────────┤       ├───────────────┤
│ id            │       │ id            │       │ id            │
│ user_id       │◄──────┤ semester      │◄──────┤ periode_id    │
│ periode_id    │       │ periode       │       │ pengajuan_ta_id│
│ tanggal       │       │ gelombang     │       │ user_id       │
│ form_ta_012   │       │ type          │       │ tanggal_sempro│
│ bukti_plagiasi│       │ status        │       │ penguji_1     │
│ proposal_ta   │       └───────────────┘       │ penguji_2     │
│ status        │                               │ ruangan       │
└───────────────┘                               └───────────────┘
```

### Tabel Utama

- **users**: Pengguna sistem dengan kolom signature untuk tanda tangan digital
- **mahasiswas**: Data profil mahasiswa terkait user
- **dosens**: Data profil dosen terkait user
- **pengajuan_ta**: Pengajuan judul dan data tugas akhir
- **bimbingans**: Catatan proses bimbingan
- **periodes**: Periode semester dan gelombang pendaftaran
- **sempros**: Data pendaftaran dan berkas seminar proposal
- **sidang_ta**: Data pendaftaran dan berkas sidang
- **jadwal_sempros/jadwal_ta**: Jadwal seminar dan sidang
- **penilaian_sempros/penilaian_sidang_tas**: Nilai seminar dan sidang
- **notifikasis**: Pemberitahuan sistem dengan tipe berbeda

## Struktur Folder

```
app/
├── Console/            # Perintah artisan
├── Exceptions/         # Handler pengecualian
├── Helpers/            # Helper classes (NilaiHelper)
├── Http/
│   ├── Controllers/    # Controller aplikasi
│   ├── Middleware/     # Middleware
│   └── Requests/       # Form requests
├── Imports/            # Import data Excel
├── Livewire/           # Komponen Livewire
│   ├── Alert
│   ├── Bimbingan/
│   ├── DataPengajuan/
│   ├── DataUser/
│   ├── Jadwal/
│   ├── Katalog/
│   ├── PengajuanTa/
│   ├── Penilaian/
│   ├── Periode/
│   ├── Referensi/
│   ├── Sempro/
│   ├── SidangTa/
│   └── UserProfile/
├── Models/             # Model Eloquent
└── Traits/             # Traits (Notifikasi, UpdateDelete)

config/                 # Konfigurasi aplikasi
database/
├── factories/          # Factory untuk testing
├── migrations/         # Database migrations
└── seeders/            # Database seeders

public/                 # File publik
resources/
├── css/                # CSS/SCSS
├── js/                 # JavaScript
└── views/              # Blade templates
    ├── components/     # Komponen UI
    ├── layouts/        # Layout halaman
    ├── livewire/       # View Livewire
    ├── pages/          # Halaman utama
    ├── pdf/            # Template PDF
    └── session/        # Halaman autentikasi

routes/                 # Definisi rute
├── api.php             # API routes
└── web.php             # Web routes

storage/                # File storage
```

## Fitur PDF

Sistem menghasilkan berbagai dokumen PDF yang diperlukan dalam proses tugas akhir:

- Form TA-001: Form pengajuan tugas akhir
- Form TA-002: Form penunjukan pembimbing
- Form TA-006: Form catatan bimbingan
- Form TA-007: Form penilaian seminar proposal
- Form TA-008: Form penilaian sidang tugas akhir
- Jadwal Seminar Proposal
- Jadwal Sidang Tugas Akhir
- Lembar Persetujuan Revisi
- Berita Acara Seminar Proposal
- Berita Acara Sidang Tugas Akhir
- Kesanggupan Revisi

## Kesimpulan

SITASI-ITK merupakan solusi komprehensif untuk manajemen tugas akhir yang menggantikan proses manual dengan sistem digital terintegrasi. Dengan memanfaatkan teknologi Laravel 10.x dan Livewire 3.x, sistem ini memberikan:

1. **Efisiensi**: Mengurangi waktu dan sumber daya dalam pengelolaan administrasi
2. **Transparansi**: Visibilitas status dan proses bagi semua pemangku kepentingan
3. **Standardisasi**: Format dan prosedur yang konsisten
4. **Kemudahan**: Antarmuka pengguna yang intuitif dan responsif
5. **Kemampuan pelacakan**: Riwayat lengkap setiap tahapan tugas akhir

Implementasi SITASI-ITK di Institut Teknologi Kalimantan diharapkan dapat meningkatkan kualitas penyelenggaraan tugas akhir dan menjadi model sistem informasi akademik yang dapat diadopsi oleh program studi atau institusi lainnya.

---

Dikembangkan oleh:
[Nama Anda]
Program Studi Informatika
Institut Teknologi Kalimantan