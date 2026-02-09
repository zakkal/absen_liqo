<div class="container-fluid py-4 font-inter">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- Main Profile Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <!-- Cover Image / Header Gradient -->
                <div class="position-relative" style="height: 180px; background: linear-gradient(135deg, #435ebe 0%, #a18cd1 100%);">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 d-flex align-items-end justify-content-between" style="background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);">
                        <div class="text-white">
                            <h3 class="fw-bold mb-1">Pengaturan Akun</h3>
                            <p class="mb-0 text-white-50 small">Kelola informasi profil dan keamanan Anda</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Sidebar Info -->
                        <div class="col-lg-4 border-end bg-light p-4 text-center">
                            <div class="position-relative d-inline-block mb-4">
                                <div class="profile-avatar shadow-lg p-1 bg-white rounded-circle" style="width: 140px; height: 140px;">
                                    @if ($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" class="rounded-circle w-100 h-100 object-fit-cover">
                                    @elseif ($current_photo)
                                        <img src="{{ asset('storage/' . $current_photo) }}" class="rounded-circle w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="bg-primary rounded-circle w-100 h-100 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person text-white" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Upload Button -->
                                <label for="photo" class="btn btn-primary rounded-circle position-absolute bottom-0 end-0 shadow-sm d-flex align-items-center justify-content-center p-0 hover-scale transition-all" style="width: 40px; height: 40px; cursor: pointer; border: 3px solid white;">
                                    <i class="bi bi-camera-fill"></i>
                                    <input type="file" id="photo" wire:model="photo" class="d-none" accept="image/*">
                                </label>

                                <!-- Loading Spinner -->
                                <div wire:loading wire:target="photo" class="position-absolute top-50 start-50 translate-middle">
                                    <div class="spinner-border text-white" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>

                            <h5 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h5>
                            <span class="badge bg-soft-primary text-primary px-3 rounded-pill small uppercase tracking-wider mb-4" style="background-color: #e9ecef;">
                                {{ strtoupper(Auth::user()->role ?? 'MEMBER') }}
                            </span>

                            <div class="text-start space-y-3 mt-4 px-2">
                                <div class="d-flex align-items-center p-3 bg-white rounded-3 shadow-sm mb-3">
                                    <div class="icon-box bg-blue-100 text-blue-600 rounded-3 p-2 me-3">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-[10px] fw-bold uppercase">Email</small>
                                        <span class="text-dark small fw-semibold text-truncate d-block" style="max-width: 180px;">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center p-3 bg-white rounded-3 shadow-sm">
                                    <div class="icon-box bg-emerald-100 text-emerald-600 rounded-3 p-2 me-3">
                                        <i class="bi bi-whatsapp"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-[10px] fw-bold uppercase">WhatsApp</small>
                                        <span class="text-dark small fw-semibold">{{ Auth::user()->no_wa ?? 'Belum diset' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Section -->
                        <div class="col-lg-8 p-4 p-md-5">
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 mb-5 d-flex align-items-center shadow-sm" role="alert" style="background-color: #d1fae5; color: #065f46;">
                                    <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                                    <div>
                                        <strong>Berhasil!</strong> {{ session('message') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form wire:submit.prevent="save">
                                <h6 class="text-dark fw-bold mb-4 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-primary rounded"></span> Informas Pribadi
                                </h6>
                                
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="form-label text-muted small fw-bold uppercase tracking-wide">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-person text-muted"></i></span>
                                            <input type="text" wire:model="name" class="form-control bg-light border-0 rounded-end-3 py-3" placeholder="Masukkan nama lengkap">
                                        </div>
                                        @error('name') <span class="text-danger xsmall mt-1 d-block">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label text-muted small fw-bold uppercase tracking-wide">Nomor WhatsApp</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-whatsapp text-muted"></i></span>
                                            <input type="text" wire:model="no_wa" class="form-control bg-light border-0 rounded-end-3 py-3" placeholder="Contoh: 08123456789">
                                        </div>
                                        @error('no_wa') <span class="text-danger xsmall mt-1 d-block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mt-5 pt-4 border-top d-flex justify-content-between align-items-center">
                                    <p class="text-muted small mb-0"><i class="bi bi-shield-lock me-1"></i> Data Anda aman dan terlindungi</p>
                                    <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-bold shadow-lg transition-transform hover-scale d-flex align-items-center gap-2" wire:loading.attr="disabled">
                                        <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                                        <span wire:loading wire:target="save">
                                            <div class="spinner-border spinner-border-sm" role="status"></div>
                                            Sedang Menyimpan...
                                        </span>
                                        <i class="bi bi-arrow-right" wire:loading.remove wire:target="save"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .font-inter { font-family: 'Inter', sans-serif; }
        .hover-scale:hover { transform: scale(1.05); }
        .transition-all { transition: all 0.3s ease; }
        .bg-blue-100 { background-color: #dbeafe; }
        .text-blue-600 { color: #2563eb; }
        .bg-emerald-100 { background-color: #d1fae5; }
        .text-emerald-600 { color: #059669; }
        .xsmall { font-size: 11px; }
        input:focus {
            box-shadow: none !important;
            background-color: #fff !important;
            border-bottom: 2px solid #435ebe !important;
        }
        .profile-avatar img {
            border: 4px solid #fff;
        }
        .icon-box {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .badge.bg-soft-primary {
            letter-spacing: 1px;
            font-size: 10px;
        }
    </style>
</div>

