<form method="POST" action="{{ URL::to('uploadNewFile') }}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        <label for="file">File</label>
        <input type="file" name="file" id="file">
    </div>
    <div class="row">
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
    </div>
    <button class="button-primary">Upload</button>
</form>

