<form action="{{ route('admin.image.store', ['type' => $type, 'id' => $id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Select Image:</label>
        <input type="file" name="file" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Upload</button>
</form>