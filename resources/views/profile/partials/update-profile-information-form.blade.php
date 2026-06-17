<style>
    .pf-wrap { max-width: 560px; }

    .pf-avatar-row {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
        padding: 20px;
        background: #f0f8ff;
        border: 1px solid #d0e8f8;
        border-radius: 12px;
    }

    .pf-avatar {
        width: 72px; height: 72px; border-radius: 50%;
        object-fit: cover;
        border: 3px solid #d0e8f8;
        flex-shrink: 0;
    }

    .pf-avatar-initials {
        width: 72px; height: 72px; border-radius: 50%;
        background: #235a9d; color: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 28px; font-weight: 700;
        flex-shrink: 0;
        font-family: 'Inter', sans-serif;
    }

    .pf-avatar-info { flex: 1; }
    .pf-avatar-info p { font-size: 13px; color: #64748b; margin: 4px 0 10px; }

    .btn-upload-photo {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 14px;
        background: white;
        border: 1.5px solid #d0e8f8;
        border-radius: 8px;
        font-size: 13px; font-weight: 600;
        color: #235a9d;
        cursor: pointer;
        transition: all 0.18s;
        font-family: 'Inter', sans-serif;
    }
    .btn-upload-photo:hover { background: #235a9d; color: white; border-color: #235a9d; }

    .pf-field { margin-bottom: 16px; }
    .pf-field label {
        display: block; font-size: 12px; font-weight: 600;
        color: #374151; text-transform: uppercase;
        letter-spacing: 0.6px; margin-bottom: 6px;
    }
    .pf-input-wrap { position: relative; }
    .pf-input-icon {
        position: absolute; left: 13px; top: 50%;
        transform: translateY(-50%); font-size: 15px; pointer-events: none;
    }
    .pf-input-icon-top {
        position: absolute; left: 13px; top: 12px;
        font-size: 15px; pointer-events: none;
    }
    .pf-field input,
    .pf-field textarea {
        width: 100%;
        padding: 11px 14px 11px 40px;
        border: 1.5px solid #d0e8f8;
        border-radius: 9px;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        color: #0f172a;
        background: white;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .pf-field textarea {
        resize: vertical; min-height: 90px; padding-top: 11px;
    }
    .pf-field input:focus,
    .pf-field textarea:focus {
        border-color: #235a9d;
        box-shadow: 0 0 0 3px rgba(35,90,157,0.10);
    }
    .pf-field input[readonly] {
        background: #f0f8ff; color: #64748b; cursor: default;
    }
    .pf-error { font-size: 12px; color: #dc2626; margin-top: 4px; }

    .pf-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    .pf-section-label {
        font-size: 11px; font-weight: 700; color: #235a9d;
        text-transform: uppercase; letter-spacing: 1px;
        margin: 20px 0 12px;
        display: flex; align-items: center; gap: 8px;
    }
    .pf-section-label::after {
        content: ''; flex: 1; height: 1px; background: #d0e8f8;
    }

    .pf-success {
        display: flex; align-items: center; gap: 8px;
        padding: 10px 14px;
        background: #f0fdf4; border: 1px solid #86efac;
        border-radius: 8px; margin-bottom: 20px;
        font-size: 13px; color: #15803d; font-weight: 600;
    }

    .btn-save {
        padding: 11px 28px;
        background: #235a9d; color: white;
        border: none; border-radius: 9px;
        font-size: 14px; font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: background 0.18s, box-shadow 0.18s;
        box-shadow: 0 3px 10px rgba(35,90,157,0.25);
    }
    .btn-save:hover { background: #0f3668; }

    @media (max-width: 600px) {
        .pf-form-row { grid-template-columns: 1fr; }
        .pf-avatar-row { flex-direction: column; text-align: center; }
    }
</style>

<div class="pf-wrap">

    <h3 style="font-size:17px; font-weight:700; color:#0f172a; margin-bottom:4px;">Informasi Profil</h3>
    <p style="font-size:13px; color:#64748b; margin-bottom:20px;">Update foto, nama, kontak, dan alamat kamu.</p>

    @if(session('status') === 'profile-updated')
        <div class="pf-success">✅ Profil berhasil diperbarui.</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- Avatar preview --}}
        <div class="pf-avatar-row">
            @if(auth()->user()->photo)
                <img src="{{ auth()->user()->photo }}" alt="Foto Profil"
                    class="pf-avatar" id="pfAvatarImg">
            @else
                <div class="pf-avatar-initials" id="pfAvatarInitials">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif

            <div class="pf-avatar-info">
                <strong style="font-size:14px; color:#0f172a;">Foto Profil</strong>
                <p>JPG, PNG, WEBP — maks. 2MB.<br>Kosongkan jika tidak ingin mengubah foto.</p>
                <label for="pfPhotoInput" class="btn-upload-photo">
                    📷 Ganti Foto
                </label>
                <input type="file" id="pfPhotoInput" name="photo"
                    accept="image/jpg,image/jpeg,image/png,image/webp"
                    style="display:none;" onchange="pfPreviewPhoto(this)">
            </div>
        </div>
        @error('photo') <div class="pf-error" style="margin-bottom:12px;">{{ $message }}</div> @enderror

        <div class="pf-section-label">Informasi Akun</div>

        {{-- Nama --}}
        <div class="pf-field">
            <label>Nama Lengkap</label>
            <div class="pf-input-wrap">
                <span class="pf-input-icon">👤</span>
                <input type="text" name="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    required autocomplete="name">
            </div>
            @error('name') <div class="pf-error">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="pf-field">
            <label>Email</label>
            <div class="pf-input-wrap">
                <span class="pf-input-icon">✉️</span>
                <input type="email" name="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    required autocomplete="email">
            </div>
            @error('email') <div class="pf-error">{{ $message }}</div> @enderror
        </div>

        <div class="pf-section-label">Informasi Kontak</div>

        <div class="pf-form-row">
            {{-- No. HP --}}
            <div class="pf-field">
                <label>No. Handphone</label>
                <div class="pf-input-wrap">
                    <span class="pf-input-icon">📱</span>
                    <input type="text" name="phone"
                        value="{{ old('phone', auth()->user()->phone) }}"
                        placeholder="08xx xxxx xxxx">
                </div>
                @error('phone') <div class="pf-error">{{ $message }}</div> @enderror
            </div>

            {{-- Role (readonly) --}}
            <div class="pf-field">
                <label>Role</label>
                <div class="pf-input-wrap">
                    <span class="pf-input-icon">🏷️</span>
                    <input type="text" value="{{ ucfirst(auth()->user()->role) }}" readonly>
                </div>
            </div>
        </div>

        {{-- Alamat --}}
        <div class="pf-field">
            <label>Alamat</label>
            <div class="pf-input-wrap">
                <span class="pf-input-icon-top">📍</span>
                <textarea name="address" style="padding-left:40px;"
                    placeholder="Jl. Contoh No. 1, RT/RW, Kelurahan, Kecamatan, Kota">{{ old('address', auth()->user()->address) }}</textarea>
            </div>
            @error('address') <div class="pf-error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>

    </form>
</div>

<script>
function pfPreviewPhoto(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        // Coba tampilkan ke img kalau ada, kalau tidak ada (masih initials) buat img baru
        let img = document.getElementById('pfAvatarImg');
        const initials = document.getElementById('pfAvatarInitials');

        if (!img) {
            img = document.createElement('img');
            img.id        = 'pfAvatarImg';
            img.alt       = 'Foto Profil';
            img.className = 'pf-avatar';
            if (initials) initials.replaceWith(img);
        }

        img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}
</script>