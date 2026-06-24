@php
    use Illuminate\Support\Str;
    $ctx = $imageCtx ?? 'create'; // 'create' or 'edit'
    $pfx = 'prod_' . $ctx;
@endphp

<div class="mb-1">
    <label class="form-label fw-medium">Image</label>

    {{-- Toggle Group --}}
    <div class="btn-group w-100 mb-3" role="group">
        <input type="radio" class="btn-check" name="image_type" id="{{ $pfx }}_type_file" value="file" autocomplete="off"
            {{ old('image_type', 'file') === 'file' ? 'checked' : '' }}>
        <label class="btn btn-outline-primary" for="{{ $pfx }}_type_file">
            <i class="bi bi-upload me-1"></i> Upload File
        </label>

        <input type="radio" class="btn-check" name="image_type" id="{{ $pfx }}_type_url" value="url" autocomplete="off"
            {{ old('image_type', 'file') === 'url' ? 'checked' : '' }}>
        <label class="btn btn-outline-primary" for="{{ $pfx }}_type_url">
            <i class="bi bi-link-45deg me-1"></i> Image URL
        </label>
    </div>

    {{-- File Upload Section --}}
    <div id="{{ $pfx }}_section_file" style="display: {{ old('image_type', 'file') === 'file' ? 'block' : 'none' }};">
        <input type="file" name="image" id="{{ $pfx }}_imageFile"
            class="form-control @error('image') is-invalid @enderror" accept="image/*"
            onchange="previewProductFromFile(this, '{{ $pfx }}')">

        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">JPG, PNG, WEBP — max 2MB</div>
    </div>

    {{-- URL Input Section --}}
    <div id="{{ $pfx }}_section_url" style="display: {{ old('image_type', 'file') === 'url' ? 'block' : 'none' }};">
        <input type="url" name="image_url" id="{{ $pfx }}_imageUrl"
            class="form-control @error('image_url') is-invalid @enderror" placeholder="https://example.com/image.jpg"
            value="{{ old('image_url', isset($product) && Str::startsWith($product->image ?? '', 'http') ? $product->image : '') }}"
            oninput="previewProductFromUrl(this.value, '{{ $pfx }}')">

        @error('image_url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Paste a direct image link</div>
    </div>

    {{-- New Image Preview --}}
    <div id="{{ $pfx }}_imagePreview" class="mt-3" style="display: none;">
        <p class="text-muted small mb-1">Preview:</p>
        <img id="{{ $pfx }}_previewImg" src="#" alt="Preview" class="rounded border"
            style="height: 120px; width: 120px; object-fit: cover;">
    </div>

    {{-- Current image (edit mode) — shown via JS --}}
    <div id="{{ $pfx }}_currentImageWrap" class="mt-3" style="display: none;">
        <p class="text-muted small mb-1">Current image:</p>
        <img id="{{ $pfx }}_currentImg" src="" alt="Current" class="rounded border"
             style="height: 80px; width: 80px; object-fit: cover;"
             onerror="this.src='https://placehold.co/80x80?text=Error'">
        <div class="form-text">Upload a new image or URL to replace it</div>
    </div>
</div>
