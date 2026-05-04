{{-- This form can be used for both create and edit --}}

<!-- Name Field -->
<div class="form-group mb-3">
    <label for="name">
        <i class="fa fa-heading mr-2"></i> Item Name
    </label>
    <input type="text" 
           class="form-control @error('name') is-invalid @enderror"
           id="name" 
           name="name" 
           value="{{ old('name', $item->name ?? '') }}"
           placeholder="Enter item name"
           required>
    @error('name')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>
<!-- Url Field -->
<div class="form-group mb-3">
    <label for="name">
        <i class="fa fa-heading mr-2"></i> Url Name
    </label>
    <input type="text" 
           class="form-control @error('url') is-invalid @enderror"
           id="name" 
           name="url" 
           value="{{ old('name', $item->name ?? '') }}"
           placeholder="Enter url name"
           >
    @error('url')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>
<!-- Description Field -->
<div class="form-group mb-3">
    <label for="description">
        <i class="fa fa-file-text mr-2"></i> Description
    </label>
    <textarea class="form-control @error('description') is-invalid @enderror"
              id="description" 
              name="description" 
              rows="4"
              placeholder="Enter item description">{{ old('description', $item->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>

<!-- Price Field -->
<div class="form-group mb-3">
    <label for="price">
        <i class="fa fa-dollar-sign mr-2"></i> Price
    </label>
    <input type="number" 
           step="0.01" 
           class="form-control @error('price') is-invalid @enderror"
           id="price" 
           name="price" 
           value="{{ old('price', $item->price ?? '') }}"
           placeholder="0.00"
           required>
    @error('price')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>

<!-- Category Field -->
<div class="form-group mb-3">
    <label for="category_id">
        <i class="fa fa-list mr-2"></i> Category
    </label>
    <select name="category_id" 
            id="category_id" 
            class="form-control @error('category_id') is-invalid @enderror"
            required>
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ old('category_id', $item?->category_id) == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>

<!-- Status Field -->
<div class="form-group mb-3">
    <label for="status">
        <i class="fa fa-toggle-on mr-2"></i> Status
    </label>
    <select name="status" 
            id="status" 
            class="form-control @error('status') is-invalid @enderror"
            required>
        <option value="">-- Select Status --</option>
        @foreach($statuses as $status)
            <option value="{{ $status->value }}" 
                    {{ old('status', $item->status ?? '') == $status->value ? 'selected' : '' }}>
                <i class="fa {{ $status->icon() }} mr-1"></i>
                {{ $status->label() }}
            </option>
        @endforeach
    </select>
    @error('status')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>

<!-- Featured Checkbox -->
<div class="form-group mb-3">
    <div class="form-check">
        <input type="checkbox" 
               class="form-check-input @error('featured') is-invalid @enderror"
               id="featured" 
               name="featured" 
               value="1"
               {{ old('featured', $item->featured ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="featured">
            <i class="fa fa-star mr-2"></i> Featured Product
        </label>
        @error('featured')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>