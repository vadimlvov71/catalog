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
           >
    @error('name')
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
<select name="locale" id="status" 
    class="form-control status-select @error('locale') is-invalid @enderror"" 
    style="width:120px;"
    data-form-id="formId">
    @foreach($locales as $locale)
        <option value="{{ $locale }}" 
                {{ old('locale', $item->locale ?? '') == $locale ? 'selected' : '' }}>
            {{ $locale  }} 
        </option>
    @endforeach
</select>
@error('locale')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror

<!-- locale Field -->
<!--
<div class="form-group mb-3">
    <label for="locale">
        <i class="fa fa-toggle-on mr-2"></i> locale
    </label>
   
    <select name="locale" 
            id="locale" 
            class="form-control @error('locale') is-invalid @enderror"
            required>
        <option value="">-- Select locale --</option>
        @foreach($languages as $locale))
            <option value="{{ $locale->value }}" 
                    {{ old('locale', $item->locale ?? '') == $locale ? 'selected' : '' }}>
                <i class="fa {{ $locale->icon() }} mr-1"></i>
                {{ $locale }}
            </option>
        @endforeach
    </select>
    @error('locale')
        <div class="invalid-feedback d-block">
            <i class="fa fa-times-circle mr-1"></i> {{ $message }}
        </div>
    @enderror
</div>
-->
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