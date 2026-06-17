@extends('layouts.app')

@section('content')

<style>
    .profile-section {
        margin-bottom: 32px;
    }

    .profile-header h1 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
        transition: color 0.25s ease;
    }

    body.dark-theme .profile-header h1 {
        color: white;
    }

    .profile-header p {
        font-size: 14px;
        color: #64748b;
        transition: color 0.25s ease;
    }

    body.dark-theme .profile-header p {
        color: #94a3b8;
    }

    .form-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.25s ease;
    }

    body.dark-theme .form-card {
        background: #1e293b;
        border-color: #334155;
    }

    .form-section-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
        transition: color 0.25s ease;
    }

    body.dark-theme .form-section-title {
        color: white;
    }

    .form-section-desc {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 16px;
        transition: color 0.25s ease;
    }

    body.dark-theme .form-section-desc {
        color: #94a3b8;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        transition: color 0.25s ease;
    }

    body.dark-theme .form-label {
        color: #e2e8f0;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        background: white;
        color: #111827;
        transition: all 0.2s ease;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #1e40af;
        box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
    }

    body.dark-theme .form-input,
    body.dark-theme .form-textarea {
        background: #334155;
        border-color: #475569;
        color: white;
    }

    body.dark-theme .form-input:focus,
    body.dark-theme .form-textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-error {
        font-size: 12px;
        color: #dc2626;
        margin-top: 4px;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }

    .photo-section {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        background: #f0f8ff;
        border: 1px solid #d0e8f8;
        border-radius: 10px;
        margin-bottom: 20px;
        transition: all 0.25s ease;
    }

    body.dark-theme .photo-section {
        background: #1e3a5f;
        border-color: #2d5a8c;
    }

    .photo-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        flex-shrink: 0;
        border: 3px solid #d0e8f8;
        object-fit: cover;
        transition: border-color 0.25s ease;
    }

    body.dark-theme .photo-avatar {
        border-color: #2d5a8c;
    }

    .photo-avatar-initial {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 700;
        color: white;
        border: 3px solid #d0e8f8;
        flex-shrink: 0;
    }

    .photo-info {
        flex: 1;
    }

    .photo-label {
        font-size: 13px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 4px;
        transition: color 0.25s ease;
    }

    body.dark-theme .photo-label {
        color: white;
    }

    .photo-desc {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 10px;
        transition: color 0.25s ease;
    }

    body.dark-theme .photo-desc {
        color: #94a3b8;
    }

    .btn-upload {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        background: white;
        border: 1px solid #d0e8f8;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #1e40af;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-upload:hover {
        background: #f0f8ff;
        border-color: #1e40af;
    }

    body.dark-theme .btn-upload {
        background: #334155;
        border-color: #475569;
        color: #93c5fd;
    }

    body.dark-theme .btn-upload:hover {
        background: #475569;
        border-color: #3b82f6;
    }

    .form-buttons {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
        transition: border-color 0.25s ease;
    }

    body.dark-theme .form-buttons {
        border-top-color: #334155;
    }

    .btn-secondary {
        padding: 10px 20px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-secondary:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }

    body.dark-theme .btn-secondary {
        background: #334155;
        border-color: #475569;
        color: #e2e8f0;
    }

    body.dark-theme .btn-secondary:hover {
        background: #475569;
        border-color: #64748b;
    }

    .btn-primary {
        padding: 10px 24px;
        background: #1e40af;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background: #1a3f8a;
    }

    .success-alert {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f0fdf4;
        border: 1px solid #86efac;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 13px;
        color: #15803d;
        font-weight: 600;
        margin-bottom: 20px;
        transition: all 0.25s ease;
    }

    body.dark-theme .success-alert {
        background: #064e3b;
        border-color: #059669;
        color: #86efac;
    }

    @media (max-width: 1024px) {
        .form-grid-3 {
            grid-template-columns: 1fr 1fr;
        }
        
        .form-grid-2 {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 16px;
        }

        .profile-header h1 {
            font-size: 20px;
        }

        .form-grid-2,
        .form-grid-3 {
            grid-template-columns: 1fr;
        }

        .photo-section {
            flex-direction: column;
            text-align: center;
        }

        .photo-info {
            flex: 1;
        }

        .form-buttons {
            flex-direction: column-reverse;
        }

        .btn-secondary,
        .btn-primary {
            width: 100%;
        }
    }
</style>

<div style="max-width: 600px; margin: 0 auto; padding: 0;">

    <div class="profile-header" style="margin-bottom: 28px;">
        <h1>Edit Profil</h1>
        <p>Perbarui informasi akun Anda</p>
    </div>

    @if(session('status') === 'profile-updated')
        <div class="success-alert">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:16px;height:16px;flex-shrink:0;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
            <span>Profil berhasil diperbarui</span>
        </div>
    @endif

    <!-- Informasi Profil -->
    <div class="form-card">
        <div style="margin-bottom: 20px;">
            <h3 class="form-section-title">Informasi Profil</h3>
            <p class="form-section-desc">Kelola informasi dasar akun Anda</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Photo Section -->
            <div class="photo-section">
                <div id="avatarWrap">
                    @if(auth()->user()->photo)
                        <img id="avatarImg" src="{{ auth()->user()->photo }}" alt="Foto" class="photo-avatar">
                    @else
                        @php
                            $i = strtoupper(substr(auth()->user()->name, 0, 1));
                            $c = ['#235a9d','#7c3aed','#0891b2','#059669','#d97706'];
                            $bg = $c[ord($i) % count($c)];
                        @endphp
                        <div id="avatarInitials" class="photo-avatar-initial" style="background:{{ $bg }};">{{ $i }}</div>
                    @endif
                </div>

                <div class="photo-info">
                    <p class="photo-label">Foto Profil</p>
                    <p class="photo-desc">JPG, PNG, WEBP — maks. 2MB</p>
                    <label for="photoInput" class="btn-upload">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:16px;height:16px;"><path fill-rule="evenodd" d="M1 8a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.07 3h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0116.07 6H17a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V8zm13.5 3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM10 14a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg>
                        Ubah Foto
                    </label>
                    <input type="file" id="photoInput" name="photo" accept="image/jpg,image/jpeg,image/png,image/webp" style="display:none;" onchange="previewFoto(this)">
                </div>
            </div>
            @error('photo')
                <p class="form-error">{{ $message }}</p>
            @enderror

            <!-- Name & Email -->
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="form-input">
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="form-input">
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Phone & Address -->
            <div class="form-group">
                <label class="form-label">No. Handphone</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="08xx xxxx xxxx" class="form-input">
                @error('phone') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="address" placeholder="Jl. Contoh No. 1, Kota" class="form-textarea">{{ old('address', auth()->user()->address) }}</textarea>
                @error('address') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ url()->previous() }}" class="btn-secondary">← Kembali</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Keamanan Akun -->
    <div class="form-card">
        <div style="margin-bottom: 20px;">
            <h3 class="form-section-title">Keamanan Akun</h3>
            <p class="form-section-desc">Perbarui password Anda. Minimum 8 karakter</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="form-grid-3">
                <div class="form-group">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="current_password" class="form-input">
                    @error('current_password', 'updatePassword') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-input">
                    @error('password', 'updatePassword') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-input">
                </div>
            </div>

            <div class="form-buttons">
                <div></div>
                <button type="submit" class="btn-primary">Perbarui Password</button>
            </div>
        </form>
    </div>

</div>

<script>
function previewFoto(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        let img = document.getElementById('avatarImg');
        const initials = document.getElementById('avatarInitials');
        if (!img) {
            img = document.createElement('img');
            img.id = 'avatarImg';
            img.alt = 'Foto';
            img.className = 'photo-avatar';
            if (initials) initials.replaceWith(img);
        }
        img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}
</script>

@endsection
