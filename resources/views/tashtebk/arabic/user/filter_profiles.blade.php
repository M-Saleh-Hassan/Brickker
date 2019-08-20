@foreach ($user_types as $user_type)
    @if($user_type->hasUsers())
        <div class="row">
            <h3 class="title-related">{{ucfirst($user_type->type)}}</h3>
            <div class="swiper-container swiper-multirows-profiles">
                <div class="swiper-wrapper">
                    @foreach($user_type->users()->WhereNotIn('user_type', [1,15])->OrderBy('user_type','ASC')->get() as $user)
                          <div class="swiper-slide ">
                            <div class="p-item relate-item">
                            
                                <div class="img-item">
                                    <a href="{{route('en.profile.show', [$user->username_tag])}}"><img src="{{asset('').$user->avatar}}" alt="" style="height:110px;"></a>
                                </div>
                                
                                <div class="p-info">
                                    <a href="{{route('en.profile.show', [$user->username_tag])}}"><h4> {{$user->username}} </h4></a>
                                </div>
                            </div>
                          </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <!--<div class="swiper-button-next"></div>-->
                <!--<div class="swiper-button-prev"></div>-->
            </div>
        </div>
    @endif
@endforeach
