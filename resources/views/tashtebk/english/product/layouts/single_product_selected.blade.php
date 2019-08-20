<div class="col-md-3">
    <div class="p-item relate-item">
        <div class="check"><i class="fa fa-check"></i></div>
        <div class="overlay-product">
            <div class="elements">
                <!--<a class="primary choose-main-product"  title="Add" data-content="{{$product->id}}"><i class="fa fa-plus"></i></a>-->
                <a href="{{route('en.product.index', ['title_tag'=>$product->title_tag])}}" class="success" title="view" target="_blank"><i class="fa fa-eye"></i></a>
                <a class="danger remove-main-product" title="Delete" data-content="{{$product->id}}"><i class="fa fa-close"></i></a>
            </div>
        </div>

        <div class="img-item">
            <img src="{{asset('').$product->image}}" alt="" style="height:110px;">
        </div>
        
        <div class="p-info">
            <h4>{{$product->title}}</h4>
            <div>
                <a href="#"><i class="fa fa-heart-o"></i></a>
                <a href="{{route('en.product.index', ['title_tag'=>$product->title_tag])}}"><i class="fa fa-shopping-cart"></i></a>
                <span class="price-p">{{$product->current_price}} {{$active_currency->title_en}}</span>
            </div>
        </div>

    </div>
</div>