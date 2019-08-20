<section id="home" >
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!--<ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>-->
        
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @php $active = 0; @endphp
            @foreach($slides as $slide)
                <div class="item @if($active == 0) {{'active'}} <?php $active=1;?> @endif">
                    <img src="{{asset('')}}{{$slide->media()->link}}" alt="{{$slide->title}}">
                    <div class="overlay"></div>
                    <div class="carousel-caption">
                        <h3 class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">{{$slide->title}}</h3>
                    <p class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.5s">{{strip_tags($slide->text)}}</p>
                       
                    </div>
                </div>
            @endforeach
        </div>
        <div class="button-center">
           @if(Auth::check())
               <a href="{{route('en.about.index')}}" class="btn-home box-shadow margin-top">Let's Get Started</a>
           @else
               <a type="button" data-toggle="modal" data-target="#Login-Modal" class="btn-home box-shadow margin-top">Let's Get Started</a>
           @endif
           
           @if(!Auth::check())
               <a href="{{route('en.about.index')}}" class="btn-home box-shadow tr-bg">Read More</a>
           @endif

        </div>
      
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
        <div class="steps-feature">
                <div class="step">
                    <img src="{{asset('tashtebk/images/s.png')}}" alt="">
                </div>
                <div class="sperate">
                    <img src="{{asset('tashtebk/images/arrow1.png')}}" alt="">
                </div>
                <div class="step">
                    <img src="{{asset('tashtebk/images/hand.png')}}" alt="">
                </div>
                <div class="sperate">
                    <img src="{{asset('tashtebk/images/arrow2.png')}}" alt="">
                </div>
                <div class="step">
                    <img src="{{asset('tashtebk/images/people.png')}}" alt="">
                </div>
                <div class="sperate">
                        <img src="{{asset('tashtebk/images/arrow1.png')}}" alt="">
                    </div>
                <div class="step">
                    <img src="{{asset('tashtebk/images/check.png')}}" alt="">
                </div>
                
            </div>
    </div>
    
</section>

<style>
    .button-center{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        
      
    flex-direction: column;
         display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
        
    }
    .tr-bg{
        background:transparent !important ;
        transform:scale(0.9);
            border: 4px solid #fff;
    }
    .tr-bg:hover{
        background:#fff !important ;
 border: 4px solid #003662;
    }
    .margin-top{
            margin-top: 100px ;
            
}
    @media only screen and (max-width: 1200px) {
        .margin-top{
            margin-top: 110px ;
            
}

    } 
     @media only screen and (max-width: 768px) {
        .margin-top{
            margin-top: 140px;
}
    }
    @media only screen and (max-width: 667px) {
        .margin-top{
            margin-top: 160px;
}
    }
     @media only screen and (max-width: 576px) {
        .margin-top{
            margin-top: 180px;
}
    }
      @media only screen and (max-width: 481px) {
        .margin-top{
            margin-top: 240px;
}
    }
  
</style>