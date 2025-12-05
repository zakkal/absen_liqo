# 📢 Fitur Pengumuman dengan Lokasi dan Prioritas

## 🎯 Deskripsi
Fitur pengumuman lengkap yang memungkinkan admin untuk:
- Membuat pengumuman atau materi pembelajaran
- Menandai pengumuman sebagai **PENTING**
- Menambahkan **lokasi kegiatan**
- Membedakan antara **Pengumuman** dan **Materi**

User/anggota dapat melihat semua informasi ini dengan tampilan yang menarik dan terorganisir.

## ✨ Fitur Utama

### Untuk Admin:
1. **Tipe Konten**
   - Pengumuman (gradient indigo-purple)
   - Materi (gradient blue-cyan)

2. **Penanda Penting**
   - Checkbox untuk menandai pengumuman penting
   - Badge merah "PENTING" dengan animasi pulse
   - Pengumuman penting ditampilkan di urutan teratas

3. **Lokasi Kegiatan**
   - Field opsional untuk menambahkan lokasi
   - Ditampilkan dengan icon lokasi yang menarik
   - Berguna untuk pengumuman acara/kegiatan

4. **Filter**
   - Filter berdasarkan tipe (Semua/Pengumuman/Materi)
   - Tabs yang interaktif dan modern

5. **CRUD Lengkap**
   - Create: Tambah pengumuman baru
   - Read: Lihat daftar dalam card grid
   - Update: Edit pengumuman existing
   - Delete: Hapus dengan konfirmasi

### Untuk User/Anggota:
1. **Tampilan Terorganisir**
   - Card grid yang responsive
   - Badge untuk tipe dan status penting
   - Gradient berbeda untuk pengumuman vs materi

2. **Filter & Search**
   - Filter tabs (Semua/Pengumuman/Materi)
   - Search bar dengan live search
   - Pencarian berdasarkan judul, isi, atau lokasi

3. **Informasi Lengkap**
   - Judul dan isi pengumuman/materi
   - Lokasi kegiatan (jika ada)
   - Tanggal dibuat
   - Badge "PENTING" untuk pengumuman prioritas

4. **Modal Detail**
   - View lengkap dengan scroll
   - Gradient sesuai tipe
   - Semua badge dan informasi ditampilkan

## 🗂️ Struktur Database

### Tabel: `materies`
```sql
- id (bigint, primary key)
- judul (string, 255)
- materi (text)
- is_important (boolean, default: false)  ← BARU
- location (text, nullable)                ← BARU
- type (enum: 'pengumuman', 'materi')     ← BARU
- created_at (timestamp)
- updated_at (timestamp)
```

## 📁 File yang Dibuat/Dimodifikasi

### Migration:
- `database/migrations/2025_12_05_043841_add_fields_to_materies_table.php`

### Model:
- `app/Models/materi.php` - Updated fillable dan casts

### Admin (Livewire):
- `app/Livewire/Admin/Pengumuman.php` - Component dengan CRUD lengkap
- `resources/views/livewire/admin/pengumuman.blade.php` - View modern dengan modals

### User/Anggota (Livewire):
- `app/Livewire/Anggota/MateriPembelajaran.php` - Updated dengan filter
- `resources/views/livewire/anggota/materi-pembelajaran.blade.php` - Updated UI

### Routes:
- `routes/web.php` - Fixed middleware dan routes

## 🎨 Desain UI

### Admin View:
- **Header**: Gradient indigo-purple dengan tombol tambah
- **Filter Tabs**: Toggle antara Semua/Pengumuman/Materi
- **Cards**: 
  - Gradient berbeda per tipe
  - Badge penting dengan animasi pulse
  - Badge tipe (PENGUMUMAN/MATERI)
  - Lokasi ditampilkan dalam box amber
  - Tombol edit & delete di header card
- **Modals**:
  - Create: Gradient indigo-purple
  - Edit: Gradient blue-cyan
  - Delete: Gradient red-pink dengan warning

### User View:
- **Header**: Judul besar dengan gradient
- **Filter Tabs**: Sama seperti admin
- **Search Bar**: Live search dengan debounce
- **Cards**:
  - Gradient sesuai tipe
  - Badge penting (animate-pulse)
  - Badge tipe
  - Lokasi dalam box amber
  - Hover effect yang smooth
- **Modal Detail**:
  - Full screen dengan scroll
  - Semua informasi lengkap
  - Gradient sesuai tipe

## 🔗 Routes

### Admin:
- **URL**: `/admin/pengumuman`
- **Route Name**: `admin.pengumuman`
- **Middleware**: `auth`, `role:admin`

### User/Anggota:
- **URL**: `/anggota/materi`
- **Route Name**: `materi`
- **Middleware**: `auth`, `role:anggota`

## 💡 Cara Penggunaan

### Sebagai Admin:

#### 1. Membuat Pengumuman Biasa:
1. Klik "Tambah Pengumuman"
2. Pilih tipe: "Pengumuman"
3. Isi judul dan materi
4. (Opsional) Tambahkan lokasi
5. Klik "Simpan"

#### 2. Membuat Pengumuman Penting:
1. Klik "Tambah Pengumuman"
2. **Centang** "Tandai sebagai Pengumuman Penting"
3. Isi data lainnya
4. Klik "Simpan"
5. Pengumuman akan muncul dengan badge merah "PENTING"

#### 3. Membuat Materi dengan Lokasi:
1. Klik "Tambah Pengumuman"
2. Pilih tipe: "Materi"
3. Isi judul dan materi
4. Isi lokasi (contoh: "Masjid Al-Ikhlas, Jl. Raya No. 123")
5. Klik "Simpan"

### Sebagai User/Anggota:

#### 1. Melihat Semua:
1. Buka `/anggota/materi`
2. Klik tab "Semua"
3. Lihat semua pengumuman dan materi

#### 2. Filter Berdasarkan Tipe:
1. Klik tab "Pengumuman" untuk lihat pengumuman saja
2. Klik tab "Materi" untuk lihat materi saja

#### 3. Mencari:
1. Ketik di search bar
2. Hasil akan muncul otomatis (debounce 300ms)
3. Bisa cari berdasarkan judul, isi, atau lokasi

#### 4. Lihat Detail:
1. Klik card pengumuman/materi
2. Modal akan terbuka dengan informasi lengkap
3. Klik "Mengerti" atau tombol X untuk tutup

## 🎯 Fitur Khusus

### 1. Prioritas Pengumuman Penting
Pengumuman yang ditandai penting akan:
- Muncul di urutan **teratas**
- Memiliki badge merah "PENTING" dengan **animasi pulse**
- Lebih menonjol secara visual

### 2. Gradient Berbeda per Tipe
- **Pengumuman**: Indigo → Purple (ungu)
- **Materi**: Blue → Cyan (biru muda)
- Memudahkan user membedakan jenis konten

### 3. Lokasi Kegiatan
- Ditampilkan dalam box **amber/orange**
- Icon lokasi yang jelas
- Opsional (tidak wajib diisi)

### 4. Live Search
- Debounce 300ms (tidak langsung search saat mengetik)
- Cari di judul, isi, DAN lokasi
- Clear button untuk reset pencarian

## 📊 Contoh Use Case

### Use Case 1: Pengumuman Acara Penting
```
Tipe: Pengumuman
Penting: ✅ Ya
Judul: Halaqah Akbar Bulan Ramadan
Materi: Harap semua anggota hadir tepat waktu. Acara dimulai pukul 19:00 WIB.
Lokasi: Masjid Al-Ikhlas, Jl. Raya No. 123, Jakarta
```
**Hasil**: Card dengan badge "PENTING" merah, gradient purple, dan box lokasi amber.

### Use Case 2: Materi Pembelajaran Biasa
```
Tipe: Materi
Penting: ❌ Tidak
Judul: Adab Menuntut Ilmu
Materi: [Isi materi panjang tentang adab menuntut ilmu...]
Lokasi: (kosong)
```
**Hasil**: Card dengan gradient biru, tanpa badge penting, tanpa box lokasi.

### Use Case 3: Pengumuman Biasa dengan Lokasi
```
Tipe: Pengumuman
Penting: ❌ Tidak
Judul: Kajian Rutin Minggu Ini
Materi: Kajian rutin akan membahas tema akhlak.
Lokasi: Musholla An-Nur, Komplek Perumahan Hijau
```
**Hasil**: Card gradient purple, ada box lokasi, tanpa badge penting.

## 🔧 Catatan Teknis

### Validation Rules:
```php
'judul' => 'required|string|max:255'
'materi' => 'required|string'
'location' => 'nullable|string|max:500'
'type' => 'required|in:pengumuman,materi'
'is_important' => 'boolean' (handled by checkbox)
```

### Query Order:
```php
->orderBy('is_important', 'desc')  // Penting dulu
->latest()                          // Terbaru dulu
```

### Middleware Fix:
Sebelumnya ada kesalahan:
- ❌ Route `anggota` pakai `role:admin`
- ❌ Route `admin` pakai `role:anggota`

Sudah diperbaiki:
- ✅ Route `anggota` pakai `role:anggota`
- ✅ Route `admin` pakai `role:admin`

## 🚀 Testing

1. **Migrate Database**:
   ```bash
   php artisan migrate
   ```

2. **Test sebagai Admin**:
   - Login sebagai admin
   - Buka `/admin/pengumuman`
   - Buat pengumuman penting dengan lokasi
   - Buat materi biasa tanpa lokasi
   - Test edit dan delete

3. **Test sebagai User**:
   - Login sebagai anggota
   - Buka `/anggota/materi`
   - Lihat pengumuman penting muncul di atas
   - Test filter tabs
   - Test search
   - Klik card untuk lihat detail

## 🎉 Hasil Akhir

Fitur pengumuman yang **lengkap**, **modern**, dan **user-friendly** dengan:
- ✅ Penanda pengumuman penting
- ✅ Informasi lokasi kegiatan
- ✅ Pembedaan tipe konten
- ✅ Filter dan search
- ✅ UI yang menarik dengan gradient dan animasi
- ✅ Responsive design
- ✅ CRUD lengkap untuk admin
- ✅ View yang informatif untuk user

Sekarang admin bisa memberikan pengumuman dan lokasi untuk user dengan mudah! 🎊
