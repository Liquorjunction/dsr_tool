@php
    $src = $picture ?? null;
    $alt = 'User Picture';
    $imgClass = 'datatable-profile-picture';
    $size = 40; // Default size for placeholder
    // If the src is not a full URL, prepend asset()
    if ($src && !preg_match('/^https?:\/\//', $src)) {
        $src = asset('storage/' . ltrim($src, '/'));
    }
@endphp

@if ($src)
    <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $imgClass }}"
        style="width:40px; height:40px; object-fit:cover; border-radius:50%; border:1px solid #e0e0e0;" />
@else
    <span
        style="width:{{ $size }}px;height:{{ $size }}px;display:inline-flex;align-items:center;justify-content:center;border-radius:50%;background:#e6eaf3;color:#7b9ef5;font-size:1.2em;box-shadow:0 1px 4px rgba(0,0,0,.10);">
        <i class="mdi mdi-account"></i>
    </span>
@endif
