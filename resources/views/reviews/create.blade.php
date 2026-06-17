@extends('layouts.app')

@section('content')

<style>
    .review-wrap {
        max-width: 760px;
        margin: 0 auto;
        padding: 8px 0 40px;
    }

    /* ── PAGE HEADER ── */
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }

    .page-header p {
        font-size: 13.5px;
        color: var(--muted);
    }

    .btn-secondary-link {
        padding: 9px 18px;
        background: var(--white);
        color: #475569;
        text-decoration: none;
        border-radius: 9px;
        font-size: 13.5px;
        font-weight: 600;
        border: 1.5px solid var(--border);
        white-space: nowrap;
        transition: all 0.18s;
        display: inline-block;
    }

    .btn-secondary-link:hover {
        background: var(--light);
        border-color: var(--navy);
        color: var(--navy);
    }

    /* ── ORDER SUMMARY CARD ── */
    .order-summary-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(35, 90, 157, 0.07);
        margin-bottom: 18px;
        overflow: hidden;
    }

    .order-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
    }

    .order-service-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .order-service-icon {
        width: 42px; height: 42px;
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    .order-service-info strong {
        display: block;
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
    }

    .order-service-info span {
        font-size: 12px;
        color: var(--muted);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge.completed { background: #ecfdf5; color: #16a34a; }

    .order-card-body {
        padding: 18px 22px;
    }

    .order-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px 24px;
        margin-bottom: 16px;
    }

    .order-detail-item .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .order-detail-item .detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
    }

    .order-detail-item.full {
        grid-column: 1 / -1;
    }

    .order-problem-box {
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 14px 16px;
    }

    .order-problem-box .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .order-problem-box p {
        font-size: 13.5px;
        color: #334155;
        line-height: 1.6;
    }

    /* ── EXISTING REVIEW BOX ── */
    .review-box {
        background: var(--light);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px 18px;
        margin-bottom: 18px;
    }

    .review-box strong {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
    }

    .review-box .rating-line {
        margin-top: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
    }

    .review-box .stars {
        color: #f59e0b;
        font-size: 18px;
        margin-left: 6px;
        letter-spacing: 2px;
    }

    .review-box p.comment {
        margin-top: 8px;
        font-size: 13.5px;
        color: #334155;
        line-height: 1.6;
    }

    /* ── REVIEW FORM CARD ── */
    .review-form-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(35, 90, 157, 0.07);
        padding: 22px;
    }

    .review-form-card h2 {
        font-size: 17px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .review-form-card .form-subtitle {
        font-size: 13px;
        color: var(--muted);
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    /* Star rating input */
    .star-rating {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 4px;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label.star {
        font-size: 30px;
        color: #e2e8f0;
        cursor: pointer;
        transition: color 0.15s, transform 0.1s;
        margin: 0;
    }

    .star-rating label.star:hover,
    .star-rating label.star:hover ~ label.star {
        color: #fbbf24;
        transform: scale(1.08);
    }

    .star-rating input[type="radio"]:checked ~ label.star {
        color: #f59e0b;
    }

    .rating-helper {
        margin-top: 6px;
        font-size: 12px;
        color: var(--muted);
    }

    .form-group textarea {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 12px 14px;
        font: inherit;
        font-size: 13.5px;
        background: var(--white);
        min-height: 130px;
        resize: vertical;
        transition: border-color 0.18s;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: var(--navy);
    }

    /* ── ACTIONS ── */
    .button-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .btn-submit {
        padding: 11px 22px;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 9px;
        font-size: 13.5px;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        white-space: nowrap;
        transition: background 0.18s, box-shadow 0.18s, transform 0.1s;
        box-shadow: 0 3px 10px rgba(35, 90, 157, 0.25);
    }

    .btn-submit:hover {
        background: var(--navy-mid, #1a4a8a);
        box-shadow: 0 5px 16px rgba(35, 90, 157, 0.35);
    }

    .btn-submit:active {
        transform: scale(0.98);
    }

    @media (max-width: 560px) {
        .order-detail-grid { grid-template-columns: 1fr; }
        .button-row { flex-direction: column; align-items: stretch; }
        .button-row .btn-secondary-link,
        .button-row .btn-submit { text-align: center; }
    }
</style>

<div class="review-wrap">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1>Beri Review</h1>
            <p>Bagikan pengalamanmu terhadap layanan teknisi.</p>
        </div>
        <a href="/orders/history" class="btn-secondary-link">← Riwayat Order</a>
    </div>

    {{-- ORDER SUMMARY --}}
    <div class="order-summary-card">
        <div class="order-card-header">
            <div class="order-service-info">
                <div class="order-service-icon">🔧</div>
                <div>
                    <strong>{{ $order->service?->service_name }}</strong>
                    <span>{{ $order->updated_at?->format('d M Y, H:i') }}</span>
                </div>
            </div>
            <span class="status-badge completed">✅ Completed</span>
        </div>

        <div class="order-card-body">
            <div class="order-detail-grid">
                <div class="order-detail-item">
                    <div class="detail-label">Teknisi</div>
                    <div class="detail-value">{{ $order->technician?->user?->name ?? '-' }}</div>
                </div>

                <div class="order-detail-item">
                    <div class="detail-label">Harga</div>
                    <div class="detail-value">Rp {{ number_format($order->price) }}</div>
                </div>

                <div class="order-detail-item full">
                    <div class="detail-label">Alamat</div>
                    <div class="detail-value">{{ $order->address }}</div>
                </div>
            </div>

            <div class="order-problem-box">
                <div class="detail-label">Problem</div>
                <p>{{ $order->problem_description }}</p>
            </div>
        </div>
    </div>

    {{-- EXISTING REVIEW --}}
    @if ($review)
        <div class="review-box">
            <strong>Rating kamu saat ini</strong>
            <p class="rating-line">
                {{ number_format($review->rating, 1, ',', '') }} / 5
                <span class="stars">{{ str_repeat('★', (int) $review->rating) }}{{ str_repeat('☆', 5 - (int) $review->rating) }}</span>
            </p>
            <p class="comment">{{ $review->comment ?: 'Tidak ada komentar.' }}</p>
        </div>
    @endif

    {{-- REVIEW FORM --}}
    <div class="review-form-card">
        <h2>{{ $review ? 'Update Review' : 'Tulis Review' }}</h2>
        <p class="form-subtitle">Rating kamu akan dipakai juga untuk rekap teknisi dan dashboard admin.</p>

        <form method="POST" action="/reviews">
            @csrf

            <input type="hidden" name="technician_id" value="{{ $order->technician->id }}">
            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div class="form-group">
                <label>Rating</label>

                @php $currentRating = old('rating', $review->rating ?? ''); @endphp

                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                            @checked((int) $currentRating === $i) required>
                        <label for="star{{ $i }}" class="star">★</label>
                    @endfor
                </div>

                <p class="rating-helper">Klik bintang untuk memberi nilai (1 = kurang, 5 = sangat baik).</p>
            </div>

            <div class="form-group">
                <label for="comment">Komentar</label>
                <textarea id="comment" name="comment" placeholder="Ceritakan pengalamanmu dengan teknisi ini...">{{ old('comment', $review->comment ?? '') }}</textarea>
            </div>

            <div class="button-row">
                <button type="submit" class="btn-submit">
                    {{ $review ? 'Update Rating' : 'Submit Review' }}
                </button>
                <a href="/orders/history" class="btn-secondary-link">Batal</a>
            </div>
        </form>
    </div>

</div>

@endsection