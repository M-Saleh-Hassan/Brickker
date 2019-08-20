<section  class=" sections gray">
    <div class="container text-center">
        <h2>الفئات</h2>
        <div class="swiper-container swiper-ctg">
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                    <div class="swiper-slide">
                        <a href="{{route('ar.category.show_all', ['category' => $category->title])}}" class="element">
                            <div class="ele-img">
                                <img src="{{asset('')}}{{$category->getImage()->link}}" alt="{{$category->title}}">
                            </div>
                            <h4>{{$category->title}}</h4>
                        </a>
                    </div>
                @endforeach                
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>