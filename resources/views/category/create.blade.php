<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yeni Kategori Ekle</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navigation')
<div class="container mt-5">

    <h1 class="mb-4">Yeni Kategori Ekle</h1>

    <!-- Genel hata mesajları -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="category_name">Kategori Adı</label>
            <input type="text" 
                   class="form-control @error('category_name') is-invalid @enderror" 
                   id="name" 
                   name="category_name" 
                   value="{{ old('category_name') }}" 
                   required>
            @error('category_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group form-check mt-3">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" 
           class="form-check-input" 
           id="is_active" 
           name="is_active" 
           value="1" 
           {{ old('is_active', 1) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Aktif mi?</label>
</div>

{{--

        <div class="form-group">
            <label for="price">Fiyat</label>
            <input type="number" 
                   class="form-control @error('price') is-invalid @enderror" 
                   id="price" 
                   name="price" 
                   step="0.01" 
                   value="{{ old('price') }}" 
                   required>
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
        <div class="form-group">
            <label for="description">Category</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" 
                      name="description" 
                      rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="images">Resimler</label>
            <input type="file" 
                   class="form-control-file @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" 
                   id="images" 
                   name="images[]" 
                   multiple 
                   required>
            <small class="form-text text-muted">Birden fazla resim yüklemek için Ctrl tuşuna basarak seçim yapabilirsiniz.</small>
            
            @error('images')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
            
            @error('images.*')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        --}}

        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">İptal</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>