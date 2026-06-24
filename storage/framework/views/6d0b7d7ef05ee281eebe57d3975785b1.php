<?php
    use Illuminate\Support\Str;
    $ctx = $imageCtx ?? 'create'; // 'create' or 'edit'
    $pfx = 'cat_' . $ctx; // unique prefix per modal
?>

<div class="mb-3">
    <label class="form-label fw-medium">Image</label>

    
    <div class="btn-group w-100 mb-3" role="group">
        <input type="radio" class="btn-check" name="image_type" id="<?php echo e($pfx); ?>_type_file" value="file" autocomplete="off"
            <?php echo e(old('image_type', 'file') === 'file' ? 'checked' : ''); ?>>
        <label class="btn btn-outline-primary" for="<?php echo e($pfx); ?>_type_file">
            <i class="bi bi-upload me-1"></i> Upload File
        </label>

        <input type="radio" class="btn-check" name="image_type" id="<?php echo e($pfx); ?>_type_url" value="url" autocomplete="off"
            <?php echo e(old('image_type', 'file') === 'url' ? 'checked' : ''); ?>>
        <label class="btn btn-outline-primary" for="<?php echo e($pfx); ?>_type_url">
            <i class="bi bi-link-45deg me-1"></i> Image URL
        </label>
    </div>

    
    <div id="<?php echo e($pfx); ?>_section_file" style="display: <?php echo e(old('image_type', 'file') === 'file' ? 'block' : 'none'); ?>;">
        <input type="file" name="image" id="<?php echo e($pfx); ?>_imageFile"
            class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*"
            onchange="previewCategoryFromFile(this, '<?php echo e($pfx); ?>')">

        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <div class="form-text">JPG, PNG, WEBP — max 2MB</div>
    </div>

    
    <div id="<?php echo e($pfx); ?>_section_url" style="display: <?php echo e(old('image_type', 'file') === 'url' ? 'block' : 'none'); ?>;">
        <input type="url" name="image_url" id="<?php echo e($pfx); ?>_imageUrl"
            class="form-control <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="https://example.com/image.jpg"
            value="<?php echo e(old('image_url', isset($category) && Str::startsWith($category->image ?? '', 'http') ? $category->image : '')); ?>"
            oninput="previewCategoryFromUrl(this.value, '<?php echo e($pfx); ?>')">

        <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <div class="form-text">Paste a direct image link</div>
    </div>

    
    <div id="<?php echo e($pfx); ?>_imagePreview" class="mt-3" style="display: none;">
        <p class="text-muted small mb-1">Preview:</p>
        <img id="<?php echo e($pfx); ?>_previewImg" src="#" alt="Preview" class="rounded border"
            style="height: 120px; width: 120px; object-fit: cover;">
    </div>

    
    <div id="<?php echo e($pfx); ?>_currentImageWrap" class="mt-3" style="display: none;">
        <p class="text-muted small mb-1">Current image:</p>
        <img id="<?php echo e($pfx); ?>_currentImg" src="" alt="Current" class="rounded border"
             style="height: 80px; width: 80px; object-fit: cover;"
             onerror="this.src='https://placehold.co/80x80?text=Error'">
        <div class="form-text">Upload a new image or URL to replace it</div>
    </div>
</div>
<?php /**PATH C:\Users\REAKSMEY.SAN\Desktop\online-shop\backend\resources\views/admin/categories/partials/image-input.blade.php ENDPATH**/ ?>