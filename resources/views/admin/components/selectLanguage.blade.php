
lang:{{ $item->locale }}
    <select name="locale" id="status" class="form-control status-select" style="width:120px;"
        data-form-id="formId">
        @foreach($locales as $locale)
            <option value="{{ $locale }}" 
                    {{ old('locale', $item->locale ?? '') == $locale ? 'selected' : '' }}>
                {{ $locale  }} 
            </option>
        @endforeach
    </select>
