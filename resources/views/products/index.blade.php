<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ürünler</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
.product-img {
    height: 200px;
    width: 100%;
    object-fit: cover;
}


</style>

{{--
@include('products.partial.productsbutton')
--}}

</head>
<body>
    <div>
        @include('layouts.app')
    </div>


<div class="container mt-5">
    <h1 class="mb-4">Ürünler</h1>
        <a href="{{route('products.create')}}" class="btn btn-primary mb-3">Yeni Ürün Ekle</a>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    
                    @if ($product->images->isEmpty())
                        <img src="https://via.placeholder.com/200x200" class="card-img-top product-img" alt="Ürün Resmi">
                    @else
                    <img src="{{asset($product->images->first()->image_path)}}" class="card-img-top product-img" alt="Ürün Resmi">
                    @endif 
                        
                   
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Fiyat: </strong>{{ $product->price }} TL</p>
                        <p class="card-text"><strong>Category: </strong>{{ $product->Category->category_name }} </p>
                        <div class="d-flex justify-content-between">

                            
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Düzenle</a>




                            <form id="deleteForm-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                             @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $product->id }})">Sil</button>
                            </form>
{{--

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Sil</button>

                            </form>
                            --}}

                        </div>
                    </div>
                </div>
            </div>
        @endforeach



    </div>
    {{ $products->links('pagination::simple-bootstrap-4') }}

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
function confirmDelete(productId) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu ürünü sildiğinizde geri alamazsınız!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Evet, sil!',
        cancelButtonText: 'İptal',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm-' + productId).submit();
        }
    });
}
</script>   
</body>
</html>
