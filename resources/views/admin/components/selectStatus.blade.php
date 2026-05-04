
    <input type="hidden" name="category_id" value="{{ $item->id }}">
    <select name="status" id="status{{ $item->id }}" class="form-control status-select" 
        data-form-id="formId{{ $item->id }}">
        @foreach($statuses as $status)
            <option value="{{ $status }}" 
                    {{ old('status', $item->status ?? '') == $status->value ? 'selected' : '' }}>
                {{ $status }} 
            </option>
        @endforeach
    </select>
