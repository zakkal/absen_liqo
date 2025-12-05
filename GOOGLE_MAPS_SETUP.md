# 🗺️ Panduan Setup Google Maps API untuk Lokasi

## 📋 Deskripsi
Fitur lokasi pada pengumuman sekarang menggunakan **Google Maps Places Autocomplete API** untuk memudahkan admin mencari dan memilih lokasi dengan akurat.

## ✨ Fitur Google Maps Autocomplete

### Yang Bisa Dilakukan:
1. ✅ **Autocomplete Search** - Ketik nama tempat, muncul saran otomatis
2. ✅ **Alamat Lengkap** - Mendapatkan alamat lengkap dari Google Maps
3. ✅ **Filter Indonesia** - Hasil pencarian dibatasi ke Indonesia saja
4. ✅ **Establishment & Geocode** - Bisa cari tempat (masjid, sekolah) atau alamat
5. ✅ **Livewire Compatible** - Terintegrasi sempurna dengan Livewire
6. ✅ **Styled Dropdown** - Dropdown autocomplete dengan styling custom

### Tampilan:
- Input field dengan icon search 🔍
- Dropdown suggestion saat mengetik
- Hover effect pada suggestion
- Highlight text yang cocok dengan pencarian

## 🔑 Cara Mendapatkan Google Maps API Key

### Langkah 1: Buat Project di Google Cloud Console

1. **Buka Google Cloud Console**
   - Kunjungi: https://console.cloud.google.com/
   - Login dengan akun Google Anda

2. **Buat Project Baru**
   - Klik dropdown project di bagian atas
   - Klik "New Project"
   - Nama project: `Absen Halaqah` (atau nama lain)
   - Klik "Create"

### Langkah 2: Enable Google Maps APIs

1. **Buka API Library**
   - Di sidebar, klik "APIs & Services" → "Library"
   - Atau kunjungi: https://console.cloud.google.com/apis/library

2. **Enable Places API**
   - Cari "Places API"
   - Klik pada "Places API"
   - Klik tombol "ENABLE"

3. **Enable Maps JavaScript API** (Opsional, tapi direkomendasikan)
   - Kembali ke Library
   - Cari "Maps JavaScript API"
   - Klik "ENABLE"

### Langkah 3: Buat API Key

1. **Buka Credentials**
   - Di sidebar, klik "APIs & Services" → "Credentials"
   - Atau kunjungi: https://console.cloud.google.com/apis/credentials

2. **Create Credentials**
   - Klik "CREATE CREDENTIALS"
   - Pilih "API key"
   - API key akan dibuat otomatis

3. **Copy API Key**
   - Copy API key yang muncul
   - Simpan di tempat aman

### Langkah 4: Restrict API Key (PENTING untuk Keamanan!)

1. **Edit API Key**
   - Klik icon pensil di sebelah API key yang baru dibuat
   - Atau klik nama API key

2. **Application Restrictions**
   - Pilih "HTTP referrers (web sites)"
   - Tambahkan domain Anda:
     ```
     http://localhost:8000/*
     http://127.0.0.1:8000/*
     https://yourdomain.com/*
     ```
   - Ganti `yourdomain.com` dengan domain production Anda

3. **API Restrictions**
   - Pilih "Restrict key"
   - Centang:
     - ✅ Places API
     - ✅ Maps JavaScript API (opsional)
   - Klik "Save"

### Langkah 5: Setup Billing (Gratis $200/bulan)

⚠️ **PENTING**: Google Maps API memerlukan billing account, tapi Anda mendapat **$200 kredit gratis setiap bulan**.

1. **Enable Billing**
   - Klik "Billing" di sidebar
   - Klik "Link a billing account"
   - Ikuti langkah-langkah untuk menambahkan kartu kredit/debit

2. **Free Tier**
   - $200 kredit gratis per bulan
   - Places Autocomplete: $2.83 per 1000 request
   - Dengan $200, Anda bisa ~70,000 request/bulan
   - Untuk aplikasi kecil-menengah, ini lebih dari cukup!

## 🔧 Cara Menggunakan API Key

### Update File Blade

1. **Buka file pengumuman**
   ```
   resources/views/livewire/admin/pengumuman.blade.php
   ```

2. **Cari baris ini** (sekitar baris 532):
   ```javascript
   const GOOGLE_MAPS_API_KEY = 'YOUR_GOOGLE_MAPS_API_KEY';
   ```

3. **Ganti dengan API key Anda**:
   ```javascript
   const GOOGLE_MAPS_API_KEY = 'AIzaSyAaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPp';
   ```
   *(Contoh, gunakan API key Anda sendiri)*

### Alternatif: Gunakan Environment Variable (Lebih Aman)

1. **Tambahkan di `.env`**:
   ```env
   GOOGLE_MAPS_API_KEY=AIzaSyAaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPp
   ```

2. **Update blade file**:
   ```javascript
   const GOOGLE_MAPS_API_KEY = '{{ env("GOOGLE_MAPS_API_KEY") }}';
   ```

3. **Clear config cache**:
   ```bash
   php artisan config:clear
   ```

## 🧪 Testing

### Test Autocomplete:

1. **Buka halaman admin pengumuman**
   - Login sebagai admin
   - Buka `/admin/pengumuman`

2. **Klik "Tambah Baru"**
   - Modal akan terbuka

3. **Test field Lokasi**:
   - Klik pada field "Lokasi Kegiatan"
   - Ketik: "Masjid Istiqlal"
   - Seharusnya muncul dropdown dengan suggestions
   - Klik salah satu suggestion
   - Alamat lengkap akan terisi otomatis

### Contoh Pencarian:
- ✅ "Masjid Istiqlal Jakarta"
- ✅ "Masjid Al-Ikhlas"
- ✅ "Jl. Sudirman Jakarta"
- ✅ "Universitas Indonesia Depok"
- ✅ "Sekolah Al-Azhar"

## 🎨 Customization

### Mengubah Negara Filter:

Saat ini dibatasi ke Indonesia (`id`). Untuk mengubah:

```javascript
componentRestrictions: { country: 'id' } // Indonesia
componentRestrictions: { country: 'my' } // Malaysia
componentRestrictions: { country: 'sg' } // Singapore
// Atau hapus untuk worldwide
```

### Mengubah Tipe Pencarian:

```javascript
types: ['establishment', 'geocode']
// establishment = tempat (masjid, sekolah, dll)
// geocode = alamat

// Hanya tempat:
types: ['establishment']

// Hanya alamat:
types: ['geocode']

// Semua:
types: []
```

### Styling Dropdown:

Edit bagian CSS di bawah script (sekitar baris 606):

```css
.pac-container {
    border-radius: 12px; /* Ubah radius */
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); /* Ubah shadow */
}

.pac-item:hover {
    background-color: #fef3c7; /* Ubah warna hover */
}
```

## 💰 Estimasi Biaya

### Free Tier ($200/bulan):
- **Places Autocomplete**: $2.83 per 1000 request
- **Dengan $200**: ~70,000 request/bulan
- **Per hari**: ~2,300 request/hari

### Untuk Aplikasi Kecil-Menengah:
- Jika 10 admin, masing-masing 10 pengumuman/hari
- Total: 100 request/hari
- **Biaya**: $0 (masih dalam free tier)

### Tips Hemat:
1. ✅ Restrict API key ke domain Anda saja
2. ✅ Enable caching jika perlu
3. ✅ Gunakan autocomplete hanya saat diperlukan
4. ✅ Set quota limits di Google Cloud Console

## 🔒 Keamanan

### Best Practices:

1. **Jangan commit API key ke Git**
   ```bash
   # Tambahkan ke .gitignore
   .env
   ```

2. **Gunakan Environment Variable**
   ```env
   GOOGLE_MAPS_API_KEY=your_key_here
   ```

3. **Restrict API Key**
   - HTTP referrers untuk web
   - IP addresses untuk server
   - API restrictions untuk limit API yang bisa diakses

4. **Monitor Usage**
   - Cek dashboard Google Cloud Console
   - Set alert jika usage mendekati limit

## 🐛 Troubleshooting

### 1. Autocomplete tidak muncul

**Cek:**
- ✅ API key sudah diisi?
- ✅ Places API sudah di-enable?
- ✅ Billing sudah diaktifkan?
- ✅ Domain sudah ditambahkan di restrictions?

**Solusi:**
```javascript
// Buka browser console (F12)
// Cek error messages
// Biasanya akan ada pesan error dari Google Maps
```

### 2. Error: "This API project is not authorized..."

**Penyebab**: Domain tidak ada di HTTP referrers

**Solusi**:
1. Buka Google Cloud Console
2. Edit API key
3. Tambahkan domain Anda di HTTP referrers

### 3. Error: "You must enable Billing..."

**Penyebab**: Billing belum diaktifkan

**Solusi**:
1. Buka Google Cloud Console
2. Klik "Billing"
3. Link billing account
4. Tambahkan kartu kredit/debit

### 4. Dropdown muncul di belakang modal

**Penyebab**: z-index terlalu rendah

**Solusi**: Sudah di-handle di CSS:
```css
.pac-container {
    z-index: 9999 !important;
}
```

### 5. Livewire tidak update value

**Penyebab**: Event tidak di-trigger

**Solusi**: Sudah di-handle di script:
```javascript
createInput.dispatchEvent(new Event('input'));
```

## 📚 Resources

### Dokumentasi:
- [Google Maps Platform](https://developers.google.com/maps)
- [Places Autocomplete](https://developers.google.com/maps/documentation/javascript/place-autocomplete)
- [Pricing](https://developers.google.com/maps/billing-and-pricing/pricing)

### Video Tutorial:
- [How to Get Google Maps API Key](https://www.youtube.com/results?search_query=google+maps+api+key+tutorial)

### Support:
- [Stack Overflow - Google Maps](https://stackoverflow.com/questions/tagged/google-maps)
- [Google Maps Platform Support](https://developers.google.com/maps/support)

## ✅ Checklist Setup

- [ ] Buat project di Google Cloud Console
- [ ] Enable Places API
- [ ] Buat API key
- [ ] Restrict API key (HTTP referrers + API restrictions)
- [ ] Enable billing (gratis $200/bulan)
- [ ] Copy API key
- [ ] Paste API key di file blade atau .env
- [ ] Test autocomplete
- [ ] Monitor usage di dashboard

## 🎉 Selesai!

Sekarang fitur lokasi sudah terintegrasi dengan Google Maps! Admin bisa dengan mudah mencari dan memilih lokasi kegiatan dengan akurat. 🗺️✨
