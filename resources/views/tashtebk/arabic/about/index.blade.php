@extends('tashtebk.arabic.layouts.master')

@section('content') 
<!--<div id="body" class="gray">-->
    <main class="gray">
        <section class="about sections">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 ">
                        <h4>رؤيتنا</h4>
                        <p>{{strip_tags($about->vision_text)}}</p>
                    </div>
                   
                    <div class="col-md-5 text-center mg_15" >
                       <img src="{{asset('').$about->getVisionImage()->link}}" alt="" width="90%">
                    </div>


                    <div class="col-md-5 text-center mg_15">
                      <img src="{{asset('').$about->getMissionImage()->link}}" alt="" width="90%">
                  </div>

                  <div class="col-md-7 ">
                      <h4>مهمتنا</h4>
                      <p>{{strip_tags($about->mission_text)}}</p>
                  </div>
              </div>
            </div>
        </section>
        <section class="sections why">
            <div class="container text-center">
                <h2>لماذا نحن ؟</h2>
                <img src="{{asset('').$about->getWhyUsImage()->link}}" width="70%" alt="">

            </div>
        </section>  
    </main>
      <!--</div>-->
@endsection
