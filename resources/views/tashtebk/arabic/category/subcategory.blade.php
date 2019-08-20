@extends('tashtebk.arabic.layouts.master')

@section('content') 
<div id="body" class="gray">
        <section class="banner">
          <div class="container">
              <ul class="breadcrumb">
                  <li><a href="{{route('ar.home.index')}}">Home</a></li>
                  <li><a href="{{route('ar.category.all.products', ['title_tag'=>$category->getParent()->title_tag])}}">{{$category->getParent()->title}}</a></li>
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
                              <h3>Category</h3>
                              <div class="divider"></div>
                              <label class="contain"> Basic Bilding
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Materials (379)
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Flooring (13) wall
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Finishing (27)
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Chemicals and Adhesives
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Consumables
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Consumables
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                          </div>
                          <div class="check-box">
                              <h3>Subliers</h3>
                              <div class="divider"></div>
                              <label class="contain"> Sublier 1
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Sublier 2
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Sublier 3
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Sublier 4
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Sublier 5
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Sublier 6
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                              <label class="contain"> Sublier 7
                                  <input type="checkbox" >
                                  <span class="checkmark"></span>
                              </label>
                          </div>  
                          <div class="check-box">
                              <h3>Price</h3>
                              <div class="divider"></div>
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
                                        <h4><a href="{{route('ar.product.index',['title_tag'=>$product->title_tag])}}">{{$product->title}}</a> <i class="fa fa-heart-o"></i></h4>
                                        <div>
                                            <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}">Add to Cart</a>
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