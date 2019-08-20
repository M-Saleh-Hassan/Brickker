@extends('tashtebk.english.layouts.master')

@section('content') 
<div id="body" class="gray">
        <section class="banner">
          <div class="container">
              <ul class="breadcrumb">
                  <li><a href="{{route('en.home.index')}}">Home</a></li>
                  <li>{{$category->title}}</li>
              </ul>
          </div>
        </section>
        <section class="product">
           <div class="container">
               <div class="row">
                   <div class="col-md-4 ">
                       <div class="side">
                          <div class="check-box">
                              <h3>{{$category->title}}</h3>
                              @foreach ($subcategories as $sub)
                                <label class="contain"><a href="{{route('en.category.products', ['title_tag'=>$sub->title_tag])}}"> {{$sub->title}} ({{$sub->products->count()}})</a>
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </label>                                  
                              @endforeach
                          </div>
                          <div class="check-box">
                              <h3>Providers</h3>
                              @foreach ($providers as $provider)
                                <label class="contain"> {{$provider->username}}
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </label>
                              @endforeach
                          </div>  
                          <div class="check-box">
                              <h3>Price</h3>
                              <div id="slider"></div>
                          </div>
                      </div>
                   </div>
                   <div class="col-md-8">
                       <div class="row">
                           @foreach ($products as $product)
                            <div class="col-md-3">
                                <div class="p-item">
                                    <div class="img-item">
                                            <img src="{{asset('').$product->image}}" alt="" style="height:150px;width: -webkit-fill-available;">
                                    </div>
                                    
                                    <div class="p-info">
                                        <h4><a href="{{route('en.product.index',['title_tag'=>$product->title_tag])}}">{{$product->title}}</a> <i class="fa fa-heart-o"></i></h4>
                                        <div>
                                            <a href="{{route('en.product.index', ['title_tag'=>$product->title_tag])}}">Add to Cart</a>
                                            <span>{{$product->price}}$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               
                           @endforeach
                           {{-- <div class="col-md-3">
                              <div class="p-item">
                                  <div class="img-item">
                                          <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                  </div>
                                  
                                  <div class="p-info">
                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                      <div>
                                          <a href="#">Add to Cart</a>
                                          <span>15$</span>
                                      </div>
                                  </div>
                              </div>
                           </div> --}}
                           {{-- <div class="col-md-3">
                              <div class="p-item">
                                  <div class="img-item">
                                          <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                  </div>
                                  
                                  <div class="p-info">
                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                      <div>
                                          <a href="#">Add to Cart</a>
                                          <span>15$</span>
                                      </div>
                                  </div>
                              </div>
                                  
                           </div>
                           <div class="col-md-3">
                              <div class="p-item">
                                  <div class="img-item">
                                          <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                  </div>
                                  
                                  <div class="p-info">
                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                      <divn class="cart">
                                          <a href="#">Add to Cart</a>
                                          <span>15$</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                              <div class="p-item">
                                  <div class="img-item">
                                          <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                  </div>
                                  
                                  <div class="p-info">
                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                      <divn class="cart">
                                          <a href="#">Add to Cart</a>
                                          <span>15$</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="p-item">
                                  <div class="img-item">
                                      <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                  </div>
                                  
                                  <div class="p-info">
                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                      <divn class="cart">
                                          <a href="#">Add to Cart</a>
                                          <span>15$</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                      <div class="p-item">
                                          <div class="img-item">
                                                  <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                          </div>
                                          
                                          <div class="p-info">
                                              <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                              <divn class="cart">
                                                  <a href="#">Add to Cart</a>
                                                  <span>15$</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                      <div class="p-item">
                                          <div class="img-item">
                                                  <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                          </div>
                                          
                                          <div class="p-info">
                                              <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                              <divn class="cart">
                                                  <a href="#">Add to Cart</a>
                                                  <span>15$</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="p-item">
                                          <div class="img-item">
                                              <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                          </div>
                                          
                                          <div class="p-info">
                                              <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                              <divn class="cart">
                                                  <a href="#">Add to Cart</a>
                                                  <span>15$</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                              <div class="p-item">
                                                  <div class="img-item">
                                                          <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                                  </div>
                                                  
                                                  <div class="p-info">
                                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                                      <divn class="cart">
                                                          <a href="#">Add to Cart</a>
                                                          <span>15$</span>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                              <div class="p-item">
                                                  <div class="img-item">
                                                          <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                                  </div>
                                                  
                                                  <div class="p-info">
                                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                                      <divn class="cart">
                                                          <a href="#">Add to Cart</a>
                                                          <span>15$</span>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="p-item">
                                                  <div class="img-item">
                                                      <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                                  </div>
                                                  
                                                  <div class="p-info">
                                                      <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                                      <divn class="cart">
                                                          <a href="#">Add to Cart</a>
                                                          <span>15$</span>
                                                      </div>
                                                  </div>
                                              </div>
                              <div class="col-md-3">
                                      <div class="p-item">
                                      <div class="img-item">
                                          <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                      </div>
                                      
                                      <div class="p-info">
                                          <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                          <divn class="cart">
                                              <a href="#">Add to Cart</a>
                                              <span>15$</span>
                                          </div>
                                      </div>
                                  </div> --}}
                                    {{-- <div class="col-md-3">
                                        <div class="p-item">
                                            <div class="img-item">
                                                <img src="{{asset('/tashtebk/images/p.PNG')}}" alt="">
                                            </div>
                                          
                                            <div class="p-info">
                                                <h4>Cement <i class="fa fa-heart-o"></i></h4>
                                                <divn class="cart">
                                                    <a href="#">Add to Cart</a>
                                                    <span>15$</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                       </div>
                   </div>
                   
                   
              
           </div>
        </section>
      </div>

@endsection