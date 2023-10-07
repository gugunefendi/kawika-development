<!-- resources/views/upload.blade.php -->

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('upload.images') }}" enctype="multipart/form-data">
    @csrf

    <input type="file" id="images" name="images[]" multiple>
    <div id="preview-container"></div>

    <button type="submit">Unggah Gambar</button>
</form>

<script>
  const imagesInput = document.getElementById('images');
  const previewContainer = document.getElementById('preview-container');

  imagesInput.addEventListener('change', function () {
    previewContainer.innerHTML = '';

    for (let i = 0; i < this.files.length; i++) {
      const file = this.files[i];
      const reader = new FileReader();

      reader.addEventListener('load', function () {
        const imageElement = document.createElement('img');
        imageElement.src = reader.result;
        imageElement.classList.add('preview-image');
        previewContainer.appendChild(imageElement);
      });

      reader.readAsDataURL(file);
    }
  });
</script>