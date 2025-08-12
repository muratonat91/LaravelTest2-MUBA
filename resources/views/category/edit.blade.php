<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori Düzenle</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navigation')
<div class="container mt-5">

    <h1 class="mb-4">Kategori Düzenle</h1>

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

    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Kategori Adı</label>
            <input type="text" 
                   class="form-control @error('category_name') is-invalid @enderror" 
                   id="name" 
                   name="category_name" 
                   value="{{ old('category_name', $category->category_name) }}" 
                   required>
            @error('name')
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
                   {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktif mi?</label>
        </div>

        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary ml-2">İptal</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
