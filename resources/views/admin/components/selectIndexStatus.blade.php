
    <input type="hidden" name="category_id" value="{{ $item->id }}">
    <select name="indexStatus" id="statusIndex{{ $item->id }}" class="form-control status-index" 
        data-form-id="formIndexId{{ $item->id }}">
        @foreach($indexStatuses as $indexStatus)
            <option value="{{ $indexStatus }}" 
                    {{ old('status_index_page_show', $item->status_index_page_show  ?? '') == $indexStatus->value ? 'selected' : '' }}>
                {{ $indexStatus }} 
            </option>
        @endforeach
    </select>
