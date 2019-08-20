@extends('tashtebk.english.layouts.master')

@section('content') 
<!--<div id="body" class="gray">-->
    <main class="gray">
        <section class="banner">
          <div class="container">
              <ul class="breadcrumb">
                  <li><a href="index.html">Home</a></li>
                  <li>Product</li>
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
                              <div id="slider"></div>
                          </div>
                      </div>
                   </div>
                   <div class="col-md-8">
                       <div class="row">
                           @for($i=0; $i<14; $i++)
                                <div class="col-md-3">
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
                            @endfor
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
    </main>
      <!--</div>-->

@endsection