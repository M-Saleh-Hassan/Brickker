<ul>
    @foreach($products as $product)
    <li> <a href="{{ route('en.product.index', [$product->title_tag])}}" > {{$product->title}}</a></li>
    @endforeach
</ul>
