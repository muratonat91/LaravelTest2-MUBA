<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navigation')


<a class="btn btn-light"  href="{{route('products.index')}}">BACK</a>

<div class="container">
    <h1 class="my-4">{{ $product->name }}</h1>
    <p class="lead">{{ $product->description }}</p>
    <p class="h5">Fiyat: <strong>{{ $product->price }} ₺</strong></p>

    <hr>

    <h3 class="my-4">Resimler</h3>
    <div class="row">
        @foreach($product->images as $image)
        <div class="col-md-3 text-center mb-4">
            <div class="card">
                <img src="{{ asset($image->image_path) }}"  height="100vh" class="card-img-top img-fluid" alt="Resim">
                <div class="card-body">
                    {{-- Güncelleme Formu --}}
                    
             <form action="{{ route('tekresimguncelle', ['product' => $product->id, 'image' => $image->id]) }}" method="POST" enctype="multipart/form-data" class="mb-2">
    @csrf
    @method('PUT')
    <input type="file" name="image" class="form-control mb-1" required>
    <button type="submit" class="btn btn-sm btn-warning">Güncelle</button>
</form>
                    
                    {{-- Silme Formu --}}
                    
                    <form action="{{ route('tekresimsil', $image->id) }}" method="POST" onsubmit="return confirm('Resmi silmek istediğinize emin misiniz?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                    </form>

                    
                    
                </div>
            </div>
        </div>
        @endforeach


       <!-- categories için eklendi -->

<div class="form-group">
    <label for="category">Kategori</label>
    <select name="category_id" id="category" class="form-control" required>
        <option value="">Seçiniz</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" 
                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
</div>


         <!-- categories için eklendi -->
    </div>

    <hr>

    <h4 class="my-4">Yeni Resim Ekle</h4>
    <form action="{{ route('editsayfasindaresimekleme', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="images[]" multiple class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Ekle</button>
    </form>
</div>
</body>
</html>