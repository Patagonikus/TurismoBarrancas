@extends('layout')

@section('title', 'Products')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="{{ url('/') }}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Tienda</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="products-section container">
        <div class="sidebar">
            <h3>Por Categoria</h3>
            <ul>
                @if(!(isset($selectedCategory)))
                    <li style="font-weight: bold; text-decoration: underline;"><a href="{{ url('/shop') }}">Todo</a>
                @else
                    <li><a href="{{ url('/shop') }}">Todo</a>
                @endif

                @foreach ($categories as $category)
                    @if($category==$selectedCategory)
                        <li style="font-weight: bold; text-decoration: underline;">
                    @else
                        <li>
                    @endif
                            <a href="{{ route('shop.filterByCategory',$category->id)}}">{{$category->name}}</a>
                        </li>
                @endforeach
            </ul>
            

            <h3>Por Precios</h3>
            <ul>

                @if(!(isset($selectedPriceTag)))
                    <li style="font-weight: bold; text-decoration: underline;"><a href="{{ url('/shop') }}">Todo</a>
                @else
                    <li><a href="{{ url('/shop') }}">Todo</a>
                @endif

                @foreach ($priceTags as $priceTag)
                    @if($priceTag==$selectedPriceTag)
                        <li style="font-weight: bold; text-decoration: underline;">
                    @else
                        <li>
                    @endif
                            <a href="{{ route('shop.filterByPrice',$priceTag->id)}}">{{$priceTag->presentMinTagPrice()}} - {{$priceTag->presentMaxTagPrice()}}</a>
                        </li>
                @endforeach

            </ul>
        </div> <!-- end sidebar -->
        <div>

            @if(isset($selectedCategory))
                <h1 class="stylish-heading">{{$selectedCategory->name}}</h1>
            @else
                <h1 class="stylish-heading">Todos los productos</h1>
            @endif

            <div class="products text-center">

                @foreach ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show',$product->id)}}"><img src="{{ asset('/storage/storage/product-img/'.$product->image) }}" alt="product"></a>
                        <a href="{{ route('shop.show',$product->id)}}"><div class="product-name">{{$product->name}}</div></a>
                        <div class="product-price">{{$product->presentPrice()}}</div>
                    </div>
                @endforeach

            </div> <!-- end products -->

            <!-- enable pagination with own styles-->
            <div class="spacer"></div>
            <div>
                {{ $products->links('vendor.pagination.bootstrap-4') }}
            </div>
            
        </div>
    </div>
    

    {{-- <script>
        function boldButton(btn){
            btn.style.fontWeight =  '700';
        }
    </script> --}}

@endsection
