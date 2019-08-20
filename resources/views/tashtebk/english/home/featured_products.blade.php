<section  class=" sections gray">
    <div class="container text-center">
        <h2>featured products</h2>
        <div class="swiper-container swiper-product">
            <div class="swiper-wrapper">
                @foreach($featured_products as $product)
                    <div class="swiper-slide">
                        <a href="{{route('en.product.index',[$product->title_tag])}}" class="element">
                                <div class="ele-img">
                                    <img src="{{asset('' . $product->image)}}" alt="">
                                </div>
                                <h4>{{$product->title}}</h4>
                            </a>
                    </div>
                @endforeach
                <!--<div class="swiper-slide">-->
                <!--        <a href="#" class="element">-->
                <!--                <div class="ele-img">-->
                <!--                    <img src="{{asset('/tashtebk/images/p2.JPG')}}" alt="">-->
                <!--                </div>-->
                <!--                <h4>Product 2</h4>-->
                <!--            </a>-->
                <!--</div>-->
                <!--<div class="swiper-slide">-->
                <!--        <a href="#" class="element">-->
                <!--                <div class="ele-img">-->
                <!--                    <img src="{{asset('/tashtebk/images/p3.JPG')}}" alt="">-->
                <!--                </div>-->
                <!--                <h4>Product 3</h4>-->
                <!--            </a>-->
                <!--</div>-->
                <!--<div class="swiper-slide">-->
                <!--        <a href="#" class="element">-->
                <!--                <div class="ele-img">-->
                <!--                    <img src="{{asset('/tashtebk/images/p4.JPG')}}" alt="">-->
                <!--                </div>-->
                <!--                <h4>Product 4</h4>-->
                <!--            </a>-->
                <!--</div>-->
                <!--<div class="swiper-slide">-->
                <!--        <a href="#" class="element">-->
                <!--                <div class="ele-img">-->
                <!--                    <img src="{{asset('/tashtebk/images/p2.JPG')}}" alt="">-->
                <!--                </div>-->
                <!--                <h4>Product 5</h4>-->
                <!--            </a>-->
                <!--</div>-->
                <!--<div class="swiper-slide">-->
                <!--        <a href="#" class="element">-->
                <!--                <div class="ele-img">-->
                <!--                    <img src="{{asset('/tashtebk/images/p3.JPG')}}" alt="">-->
                <!--                </div>-->
                <!--                <h4>Product 6</h4>-->
                <!--            </a>-->
                <!--</div>-->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
