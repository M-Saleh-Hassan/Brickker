@extends('tashtebk.arabic.layouts.master')

@section('content') 
<!--<div id="body">-->
<main>
    <section class="gray section">
        <div class="container">
            @if(Auth::user()->getUserType() != NULL)
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-info box">
                        <img src="{{asset('').Auth::user()->avatar}}" alt="">
                        <h4>{{Auth::user()->real_name}}</h4>
                        <p>{{Auth::user()->short_title}}</p>
                    </div>
                    <div class="box-about box">
                        <h4>عني</h4>
                        <div class="item">
                            <h5><div class="fa fa-map-marker"></div> الموقع</h5>
                            <p>{{Auth::user()->country->title_ar}}</p>
                            <h5><div class="fa fa-phone"></div> التليفون</h5>
                            <p>{{Auth::user()->phone}}</p>
                            <h5><div class="fa fa-briefcase"></div> العمل</h5>
                            <p>{{ucfirst(Auth::user()->getUserType())}}</p>
                            <h5><div class="fa fa-building"></div> الشركة</h5>
                            <p>{{Auth::user()->company_name}}</p>
                        </div>
                        <div class="item">
                            <h5><div class="fa fa-pencil"></div> الفئات</h5>
                            <?php $i=0; ?>
                            @foreach (Auth::user()->categories as $category)
                                <?php if($i==4)$i=0?>
                                @if($i==0)<span class="label danger ">{{$category->title}}</span>@endif
                                @if($i==1)<span class="label primary">{{$category->title}}</span>@endif
                                @if($i==2)<span class="label success">{{$category->title}}</span>@endif
                                @if($i==3)<span class="label warning">{{$category->title}}</span>@endif
                                <?php $i++;?>
                            @endforeach
                        </div>
                        <div class="item">
                            <h5><div class="fa fa-file-text-o"></div> السيرة الذاتية</h5>
                            <p>{{Auth::user()->bio}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-tabs">
                        <ul class="nav nav-tabs">
                            <li @if(session('active') != 'my_products'    && $active == 'profile') class="active"        @endif><a data-toggle="tab" href="#home">البيانات الأساسية</a></li>
                            <li @if(session('active') == 'add_products'   || $active == 'add_products') class="active"   @endif><a data-toggle="tab" href="#menu1">أضف {{Auth::user()->getProductOrServiceTypeAr()}}</a></li>
                            <li @if(session('active') == 'my_products'    || $active == 'my_products') class="active"    @endif><a data-toggle="tab" href="#menu2">{{Auth::user()->getProductsOrServicesTypeAr()}}ي</a></li>
                            @if(Auth::user()->getUserType() == 'consultant')
                            <li @if(session('active') == 'add_quantities' || $active == 'add_quantities') class="active" @endif><a data-toggle="tab" href="#menu3">أضف كمية</a></li>
                            <li @if(session('active') == 'my_quantities'  || $active == 'my_quantities') class="active"  @endif><a data-toggle="tab" href="#menu4">كمياتي</a></li>
                            @endif
                             <li  class=""  ><a data-toggle="tab" href="#menu5">إدارة حسابك</a></li>
                           
                        </ul>
                        
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade 
                            @if(session('active') != 'my_products'  && $active == 'profile') in active @endif
                            ">
                                <form class="form-horizontal" method="POST" action="{{ route('ar.profile.update',['username_tag' => Auth::user()->username_tag]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الاسم الحقيقي *</label>
                    
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control"  name="real_name" placeholder="الاسم الحقيقي " value="{{(Request::old('real_name')) ? Request::old('real_name') : Auth::user()->real_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">البريد الإلكتروني*</label>
                    
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control"  name="email" placeholder="البريد الإلكتروني" value="{{(Request::old('email')) ? Request::old('email') : Auth::user()->email}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">البلد*</label>
                    
                                        <div class="col-sm-10">
                                            <select class="form-control" name="country"                                            >
                        						@foreach($countries as $country)
                        							<option value="{{$country->id}}" @if (Request::old('sign_up_country') == $country->title_en || Auth::user()->country->title_en == $country->title_en) selected @endif>
                        								{{$country->title_en}}		
                        							</option>
                        						@endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">التليفون*</label>
                    
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{(Request::old('phone')) ? Request::old('phone') : Auth::user()->phone}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">المسمى الوظيفي</label>
                    
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="short_title" placeholder="المسمى الوظيفي" value="{{(Request::old('short_title')) ? Request::old('short_title') : Auth::user()->short_title}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">اسم الشركة</label>
                    
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="company_name" placeholder="اسم الشركة" value="{{(Request::old('company_name')) ? Request::old('company_name') : Auth::user()->company_name}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">السيرة الذاتية</label>
                                        
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="bio" placeholder="السيرة الذاتية" >{{(Request::old('bio')) ? Request::old('bio') : Auth::user()->bio}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group categories-test">
                                        <label  class="col-sm-2 control-label">الفئات</label>
                                        
                                        <div class="col-sm-10">
                                            <select class="js-example-basic-multiple" name="user_categories[]" multiple="multiple">
                                                @foreach (Auth::user()->getUserTypeCategories() as $sub)
                                                <option value="{{$sub->id}}"
                                                    @foreach (Auth::user()->categories as $category)
                                                        @if ($category->id == $sub->id)
                                                            selected
                                                        @endif
                                                    @endforeach    
                                                >
                                                {{$sub->title}}
                                                </option>                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الصورة الشخصية</label>
                    
                                        <div class="col-sm-10">
                                        <input type="file" class="form-control" name="avatar">
                                        </div>
                                    </div>
    
                                    {{-- <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                            </label>
                                        </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-3 right-button">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-home">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div id="menu1" class="tab-pane fade relative
                            @if(session('active') == 'add_products' || $active == 'add_products') in active  @endif
                            ">
                                <div class="overlay-loader hidden">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                                <form class="form-horizontal" method="POST" action="{{ route('ar.profile.product.save',['username_tag' => Auth::user()->username_tag]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الفئة</label>
                                        
                                        <div class="col-sm-10">
                                            <select class="select-product-category" name="product_category">
                                                @foreach (Auth::user()->categories as $category)
                                                <option value="{{$category->id}}"
                                                  @if (Request::old('product_category') == $category->id)
                                                      selected
                                                  @endif  
                                                >
                                                    {{$category->title}}
                                                </option>                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الوحدة</label>
                                        
                                        <div class="col-sm-10">
                                            <select class="select-product-unit" name="product_unit">
                                                @foreach ($units as $unit)
                                                <option value="{{$unit->id}}"
                                                  @if (Request::old('product_unit') == $unit->id)
                                                      selected
                                                  @endif  
                                                >
                                                    {{$unit->title}}
                                                </option>                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">العنوان</label>
                    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="product_title" placeholder="عنوان {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{Request::old('product_title')}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">السعر</label>
                    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="product_price" placeholder="سعر {{Auth::user()->getProductOrServiceTypeAr()}}" min="0" value="{{Request::old('product_price')}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الخصم</label>
                    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="product_discount" placeholder="خصم {{Auth::user()->getProductOrServiceTypeAr()}}" min="0" max="99" value="{{Request::old('product_discount')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">البراند</label>
                    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="product_brand" placeholder="براند {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{Request::old('product_brand')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">اسم الموديل</label>
                    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="product_model_name" placeholder="اسم موديل {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{Request::old('product_model_name')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الدرجة</label>
                    
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="product_grade" placeholder="درجة {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{Request::old('product_grade')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">وصف قصير</label>
                                        
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="product_short_description" placeholder="وصف قصير {{Auth::user()->getProductOrServiceTypeAr()}}" >{{Request::old('product_short_description')}}</textarea>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">وصف مطول</label>
                                        
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="product_long_description" placeholder="وصف مطول {{Auth::user()->getProductOrServiceTypeAr()}}" >{{Request::old('product_long_description')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الصورة الأساسية</label>
                    
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="product_image">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">الصور الأخرى</label>
                    
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="product_other_images[]" multiple>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group additional-prices hidden">
                                        <h3>Additional Prices</h3>
                                        <div class="additional-prices-search-section">
                                            <input class="search-products" type="text" name="additional_product_filter" placeholder="Start Typing ..">
                                            <a type="button" data-toggle="modal" data-target="#ConsultantModal" class="btn btn-consult">Ask Consultant</a>
                                        </div>
                                        <div class="additional-prices-p"></div>
                                        
                                        <div class="row product-pane additional-product-result">
                                            
                                        </div>
                                        <input class="hidden" type="text" name="additional_product" value="{{Request::old('additional_product')}}">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 center-button">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-home">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>


                            <div id="menu2" class="tab-pane fade
                            @if(session('active') == 'my_products'  || $active == 'my_products') in active   @endif
                            ">
                            <style>
                                .close {
                                  position: absolute;
                                  /*top: 0;*/
                                  /*right: 40.5px;*/
                                  cursor: pointer;
                                  z-index:10;
                                  opacity:1;
                                  
                                }
                                .close:hover, .close:focus {
                                    color: white;
                                    text-decoration: none;
                                    cursor: pointer;
                                    filter: alpha(opacity=50);
                                    opacity: 1;
                                }
                                .close1 {
                                  position: absolute;
                                  /*top: 0;*/
                                  left: 43.5px;
                                  cursor: pointer;
                                  z-index:10;
                                  opacity:1;
                                  
                                }
                                .close1:hover, .close1:focus {
                                    color: white;
                                    text-decoration: none;
                                    cursor: pointer;
                                    filter: alpha(opacity=50);
                                    opacity: 1;
                                }
                            </style>
                                <div class="row product-pane">
                                    @foreach (Auth::user()->products as $product)
                                        <div class="col-md-3">
                                            
                                            <div class="modal fade" id="ProductModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        		<div class="modal-dialog extend-modal-width" role="document">
                                        		  <div class="modal-content" >
                                        			<div class="modal-header">
                                        			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        			  <h4 class="modal-title" id="myModalLabel">{{$product->title}}</h4>
                                        			</div>
                                        			<div class="modal-body">
                                        				<form class="product-edit-form" method="POST" action="{{ route('ar.profile.product.update', ['username_tag' => Auth::user()->username_tag, 'product_id' => $product->id]) }}" enctype="multipart/form-data">
                                        					@csrf
                                        					<div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label">الفئة</label>
                                                                
                                                                <div class="col-sm-10">
                                                                    <select class="select-product-category" name="product_category">
                                                                        @foreach (Auth::user()->categories as $category)
                                                                        <option value="{{$category->id}}"
                                                                          @if (Request::old('product_category') == $category->id)
                                                                              selected
                                                                          @elseif($product->category_id == $category->id)
                                                                              selected
                                                                          @endif  
                                                                        >
                                                                            {{$category->title}}
                                                                        </option>                                                    
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                        					<div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label">الوحدة</label>
                                                                
                                                                <div class="col-sm-10">
                                                                    <select class="select-product-unit" name="product_unit">
                                                                        @foreach ($units as $unit)
                                                                        <option value="{{$unit->id}}"
                                                                          @if (Request::old('product_unit') == $unit->id)
                                                                              selected
                                                                          @elseif($product->unit_id == $unit->id)
                                                                              selected
                                                                          @endif  
                                                                        >
                                                                            {{$unit->title}}
                                                                        </option>                                                    
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">العنوان</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="product_title" placeholder="عنوان {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{(empty(Request::old('product_title'))) ? $product->title : Request::old('product_title')}}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">السعر</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="product_price" placeholder="سعر {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{(empty(Request::old('product_price'))) ? $product->price : Request::old('product_price')}}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">الخصم</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="product_discount" placeholder="خصم {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{(empty(Request::old('product_discount'))) ? $product->discount : Request::old('product_discount')}}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">البراند</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="product_brand" placeholder="براند {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{(empty(Request::old('product_brand'))) ? $product->brand : Request::old('product_brand')}}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">اسم الموديل</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="product_model_name" placeholder="اسم موديل {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{(empty(Request::old('product_model_name'))) ? $product->model_name : Request::old('product_model_name')}}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">الدرجة</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="product_grade" placeholder="درجة {{Auth::user()->getProductOrServiceTypeAr()}}" value="{{(empty(Request::old('product_grade'))) ? $product->grade : Request::old('product_grade')}}">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">وصف قصير</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <textarea type="text" class="form-control" name="product_short_description" placeholder="وصف قصير {{Auth::user()->getProductOrServiceTypeAr()}}">{{(empty(Request::old('product_short_description'))) ? $product->short_description : Request::old('product_short_description')}}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">وصف مطول</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <textarea type="text" class="form-control" name="product_long_description" placeholder="وصف مطول {{Auth::user()->getProductOrServiceTypeAr()}}">{{(empty(Request::old('product_long_description'))) ? $product->long_description : Request::old('product_long_description')}}</textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">الصورة الأساسية</label>
                                                                <div class="col-sm-10">
                                                                    <input type="file" class="form-control" name="product_image">
                                                                </div>
                                                                <img src="{{asset('').$product->image}}" alt="" style="height:100px;">
                                                            </div>
                            
                                                            <div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label pad-15">الصور الأخرى</label>
                                            
                                                                <div class="col-sm-10">
                                                                    <input type="file" class="form-control" name="product_other_images[]" multiple>
                                                                    @foreach($product->images as $image)
                                                                    <div class="image-other-product">
                                                                        <img src="{{asset('').$image->image}}" alt="">
                                                                        <a href="#" class="delete delete-image" title="Delete" data-content="{{$image->id}}"><i class="fa fa-close"></i></a>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="form-group additional-prices">
                                                                <h3>Additional Prices</h3>
                                                                <div class="additional-prices-search-section">
                                                                    <input class="search-products" type="text" name="additional_product_filter" placeholder="Start Typing ..">
                                                                    <a type="button" data-toggle="modal" data-target="#ConsultantModal" class="btn btn-consult">Ask Consultant</a>
                                                                </div>
                                                                <div class="additional-prices-p"></div>
                                                                
                                                                <div class="row product-pane additional-product-result">
                                                                @foreach ($product->additionalProducts as $current)
                                                                    <div class="col-md-3">
                                                                        <div class="p-item relate-item">
                                                                            <div class="check"><i class="fa fa-check"></i></div>
                                                                            <div class="overlay-product">
                                                                                <div class="elements">
                                                                                    <a class="primary add-additional-product"  title="Add" data-content="{{$current->childProduct->title_tag}}"><i class="fa fa-plus"></i></a>
                                                                                    <a href="{{ route('ar.product.index', ['title_tag'=>$current->childProduct->title_tag])}}" class="success" title="view" target="_blank"><i class="fa fa-eye"></i></a>
                                                                                    <a class="danger delete-additional-product" title="Delete" data-content="{{$current->childProduct->title_tag}}"><i class="fa fa-close"></i></a>
                                                                                </div>
                                                                            </div>
                                                                    
                                                                            <div class="img-item">
                                                                                <img src="{{asset('').$current->childProduct->image}}" alt="" style="height:110px;">
                                                                            </div>
                                                                            
                                                                            <div class="p-info">
                                                                                <h4 class="edit-form-title">{{$current->childProduct->title}}</h4>
                                                                                <div>
                                                                                    <a href="#"><i class="fa fa-heart-o"></i></a>
                                                                                    <a href="{{route('ar.product.index', ['title_tag'=>$current->childProduct->title_tag])}}"><i class="fa fa-shopping-cart"></i></a>
                                                                                    <span class="price-p">{{$current->childProduct->current_price}} {{$active_currency->title_ar}}</span>
                                                                                </div>
                                                                            </div>
                                                                    
                                                                        </div>
                                                                    </div>                                                                  
                                                                @endforeach    
                                                                </div>
                                                                <input class="hidden" type="text" name="additional_product" value="{{empty(Request::old('additional_product')) ? $product->getadditionalProductsTags() : Request::old('additional_product')}}">
                                                            </div>      
                                                            <div class="row">
                                                                <div class="col-md-3 center-button">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-home">حفظ</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                        				</form>
                                        			</div>
                                        		  </div>
                                        		</div>
                                    	  </div>
                                            <div class="p-item relate-item">
                                                <div class="overlay-product">
                                                    <div class="elements">
                                                        <a href="{{route('ar.profile.product.delete',[Auth::user()->username_tag, $product->id])}}" class="danger" title="Delete" onclick="return confirm('Are you sure you want to Delete ?');" ><i class="fa fa-close"></i></a>
                                                        <a type="button" data-toggle="modal" data-target="#ProductModal{{$product->id}}" class="primary"  title="Edit"><i class="fa fa-edit"></i></a>
                                                        <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}" class="success" title="view" target="_blank"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                    
                                                </div>
                                                <div class="img-item">
                                                        <img src="{{asset('').$product->image}}" alt="" style="height:110px;">
                                                </div>
                                                
                                                <div class="p-info">
                                                    <h4 class="edit-form-title">{{$product->title}} </h4>
                                                    <div>
                                                        <a href="#"><i class="fa fa-heart-o"></i></a>
                                                        <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}"><i class="fa fa-shopping-cart"></i></a>
                                                        <span class="price-p">{{$product->current_price}} {{$active_currency->title_ar}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                                                    
                                    @endforeach
                                </div>
                            </div>
                            
                            <div id="menu3" class="tab-pane fade
                            @if(session('active') == 'add_quantities'  || $active == 'add_quantities') in active   @endif
                            ">
                                <div class="form-group additional-prices">
                                    <h3>Select Main Product</h3>
                                    <div class="additional-prices-search-section">
                                        <input class="search-products" type="text" name="find_main_product" placeholder="Start Typing ..">
                                        <a type="button" class="btn btn-consult show-all-main-products">Show All</a>
                                        <a type="button" class="btn btn-consult show-all-selected-main-products">Show Selected</a>
                                        <a type="button" class="btn btn-consult select-all-main-products">Select All</a>
                                        <a type="button" class="btn btn-consult reset-main-products">Reset</a>
                                        <select class="select-main-product-category" name="main_product_category">
                                            <option></option>
                                            @foreach ($parentcategories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->title}}
                                            </option>                                                    
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="additional-prices-p"></div>
                                    
                                    <div class="row product-pane main-products-result">
                                        
                                    </div>
                                    <input class="hidden" type="text" name="main_product_id" value="{{Request::old('main_product_id')}}">
                                </div>
                                
                                <div class="form-group additional-prices sub-products-container hidden">
                                    <h3>Select Sub Products</h3>
                                    <div class="additional-prices-search-section">
                                        <input class="search-products" type="text" name="find_sub_product" placeholder="Start Typing ..">
                                        <a type="button" class="btn btn-consult show-all-sub-products">Show All</a>
                                        <a type="button" class="btn btn-consult show-all-selected-sub-products">Show Selected</a>
                                        <a type="button" class="btn btn-consult select-all-sub-products">Select All</a>
                                        <a type="button" class="btn btn-consult reset-sub-products">Reset</a>
                                        <select class="select-sub-product-category" name="sub_product_category">
                                            <option></option>
                                            @foreach ($parentcategories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->title}}
                                            </option>                                                    
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="additional-prices-p"></div>
                                    
                                    <div class="row product-pane sub-products-result">
                                        
                                    </div>
                                    <input class="hidden" type="text" name="sub_product_ids" value="{{Request::old('sub_product_ids')}}">
                                    <input class="hidden" type="text" name="sub_product_quantities" value="{{Request::old('sub_product_quantities')}}">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3 center-button">
                                        <div class="form-group">
                                            <a type="button" class="btn btn-home submit-quantity">Save</a>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            
                             <div id="menu5" class="tab-pane fade">
                                <div class="row flexing">
                                    <button class="btn btn-danger deactivate"><i class="fa fa-times"></i> يقاف حسابك</button>
                                    <button class="btn btn-danger delete-account"><i class="fa fa-trash"></i> مسح حسابك</button>
                                    <button class="btn btn-warning change-type"><i class="fa fa-id-badge"></i> غيّر نوع حسابك</button>
                                </div>
                                
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row user_type_select text-center ">
                <div class="overlay-loader hidden">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <h2 class="title-p">قم باكمال ملفك الشخصي</h2>
                @foreach($user_types as $user_type)
                    <div class="col-sm-3 col-md-3">
                        <div class="box-select text-center">
                            <a href="#" data-content="{{$user_type->id}}">
                                <img src="{{asset('').$user_type->getImage->link}}" width="50px">
                                <h4 class="h-bold">{{ucfirst($user_type->type)}}</h4>
                                <!--<p>test content</p>-->
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
    </section>
</main>
<!--</div>-->
@endsection
@section('custom-js')
    $('.js-example-basic-multiple').select2();    
    $('.select-main-product-category').select2({
        placeholder: "Filter By Category",
        allowClear: true
    }); 
    $('.select-sub-product-category').select2({
        placeholder: "Filter By Category",
        allowClear: true
    }); 
    $('.select-product-unit').select2(); 
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    $( ".user_type_select" ).on( "click", "a", function() {
        if(confirm('هل انت متأكد أن ذلك سيكون نوع الأكونت الخاص بك دائما ؟'))
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var user_type  = $( this ).data( "content" );
            
            $.ajax({
                url:"{{ route('ar.profile.type', [Auth::user()->username_tag]) }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, user_type:user_type},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success:function(data)
                {
                    window.location.href = data.redirect;
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });

    $( '.change-type' ).on('click',function(){
    
        if(confirm('ملاحظة:: سيتم مسح جميع بياناتك الحالية عند تغيير نوع الأكونت !!'))
        {
            var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('ar.profile.changeType') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    window.location.href = data.redirect;
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });

    $( '.delete-account' ).on('click',function(){
    
        if(confirm('هل أنت متأكد من مسح هذا الأكونت نهائيا ؟'))
        {
            var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('ar.profile.delete') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    window.location.href = data.redirect;
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });
    
    $( '.deactivate' ).on('click',function(){
    
        if(confirm('هل انت متأكد من اياف تفعيل اكونتك ؟'))
        {
            var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('ar.profile.deactivate') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    window.location.href = data.redirect;
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });
    
    $( "input[name='additional_product_filter']" ).on('keyup',function(){
        
        var search_value = $(this).val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var additional_products_current_value = $("input[name='additional_product']").val();
        
        $.ajax({
            url:"{{ route('ar.profile.product.filter', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, search_value:search_value, additional_products_current_value:additional_products_current_value},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.additional-product-result').html('');
                $('.additional-product-result').html(data.result);
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
    });

    $('.additional-product-result').on('click', '.add-additional-product', function(){
    
        var content = $( this ).data( "content" );
        var current_value = $("input[name='additional_product']").val();
        
        if(current_value.indexOf(content) == -1)
        {
            if (current_value === "") current_value += content;
            else current_value += ',' + content;
            
            $("input[name='additional_product']").val(current_value);
            console.log($("input[name='additional_product']").val());
            
            $(this).closest('.p-item').prepend('<div class="check"><i class="fa fa-check"></i></div>');
        }
    }); 
    
    $('.additional-product-result').on('click', '.delete-additional-product', function(){
    
        var content = $( this ).data( "content" );
        var current_value = $("input[name='additional_product']").val();

        if(current_value.indexOf(content) != -1)
        {
            var new_value = current_value.replace(',' + content, "");  
            new_value = new_value.replace(content + ',', "");  
            new_value = new_value.replace(content, "");  
            
            $("input[name='additional_product']").val(new_value);
            console.log($("input[name='additional_product']").val());
            
            $(this).closest('.p-item').find('div').first().remove();
        }
    });    

    $( "input[name='find_main_product']" ).on('keyup',function(){
        
        var search_value = $(this).val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var main_product_id = $("input[name='main_product_id']").val();
        
        $.ajax({
            url:"{{ route('ar.profile.product.quantity.main.filter', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, search_value:search_value, main_product_id:main_product_id},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.main-products-result').html('');
                $('.main-products-result').html(data.products);
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
    });

    $( "select[name='main_product_category']" ).on('change',function(){
    
        var category_id = $( this ).val();
        var main_product_id = $("input[name='main_product_id']").val();

        $.ajax({
            url:"{{ route('ar.profile.product.quantity.main.filter.category', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, category_id:category_id, main_product_id:main_product_id},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.main-products-result').html('');
                $('.main-products-result').html(data.products);
                if(data.products)$(".sub-products-container").removeClass('hidden');
                else if(!$(".sub-products-container").hasClass('hidden')) $(".sub-products-container").addClass('hidden');
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    
    $('.main-products-result').on('click', '.choose-main-product', function(){
        /*
        var main_product_id = $( this ).data( "content" );
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("input[name='main_product_id']").val(main_product_id);
        
        $.ajax({
            url:"{{ route('ar.profile.product.quantity.main.choose', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, main_product_id:main_product_id},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.main-products-result').html('');
                $('.main-products-result').html(data.main_product);
                $(".sub-products-container").removeClass('hidden');
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
        */
        
        var product_id  = $( this ).data( "content" );
        var current_value = $("input[name='main_product_id']").val();

        if(current_value.indexOf(product_id) == -1)
        {
            if (current_value === "") current_value += product_id;
            else current_value += ',' + product_id;

            $("input[name='main_product_id']").val(current_value);

            $(this).closest('.p-item').prepend('<div class="check"><i class="fa fa-check"></i></div>');
        }

    });
    
    $('.main-products-result').on('click', '.remove-main-product', function(){
        /* This code works on condition that one main product will be selected */
        /* ******
        var main_product_id = $( this ).data( "content" );
        $("input[name='main_product_id']").val('');

        $.ajax({
            url:"{{ route('ar.profile.product.quantity.main.all', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, main_product_id:0},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.main-products-result').html('');
                $('.main-products-result').html(data.all_products);
                $(".sub-products-container").removeClass('hidden');
                $(".sub-products-container").addClass('hidden');
                $("input[name='find_main_product']").val('');
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
        ******* */
        /* This code works on condition that more than one product will be selected at he same time */
        var product_id  = $( this ).data( "content" );

        var current_value = $("input[name='main_product_id']").val();

        if(current_value.indexOf(product_id) != -1)
        {
            var new_value = current_value.replace(',' + product_id, "");  
            new_value = new_value.replace(product_id + ',', "");  
            new_value = new_value.replace(product_id, ""); 
            

            $("input[name='main_product_id']").val(new_value);
            console.log($("input[name='main_product_id']").val());

            $(this).closest('.p-item').find('div').first().remove();

        }

    });
    
    $( '.show-all-main-products' ).on('click',function(){
    
        var main_product_id = $("input[name='main_product_id']").val();

        $.ajax({
            url:"{{ route('ar.profile.product.quantity.main.all', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, main_product_id:main_product_id},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.main-products-result').html('');
                $('.main-products-result').html(data.all_products);
                if($("input[name='main_product_id']").val())$(".sub-products-container").removeClass('hidden');
                $("input[name='find_main_product']").val('');
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
    });

    $( '.show-all-selected-main-products' ).on('click',function(){
    
        var main_product_ids = $("input[name='main_product_id']").val();

        $.ajax({
            url:"{{ route('ar.profile.product.quantity.main.selected', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, main_product_ids:main_product_ids},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.main-products-result').html('');
                $('.main-products-result').html(data.selected_main_products);
                $("input[name='find_main_product']").val('');
                //$(".overlay-loader").toggleClass('hidden');
                if(data.selected_main_products)$(".sub-products-container").removeClass('hidden');
                else $(".sub-products-container").addClass('hidden');
            }
        });
    });
    
    $( '.select-all-main-products' ).on('click',function(){
    
        var main_product_ids = $("input[name='main_product_id']").val();
        var main_products_result = $('.main-products-result').find('.danger');
        $("input[name='main_product_id']").val('');
        var current_value = $("input[name='main_product_id']").val();
        
        main_products_result.each(function( index ) {
            var product_id = $( this ).data( 'content' );
            
            if(current_value.indexOf(product_id) == -1)
            {
                if (current_value === "") current_value += product_id;
                else current_value += ',' + product_id;
    
                $("input[name='main_product_id']").val(current_value);
    
                $(this).closest('.p-item').prepend('<div class="check"><i class="fa fa-check"></i></div>');
            }

        });
        console.log($("input[name='main_product_id']").val())
    });
    
    $( '.reset-main-products' ).on('click',function(){
    
        $("input[name='main_product_id']").val('');
        $('.main-products-result').html('');
        $(".sub-products-container").addClass('hidden');
        //$(".select-main-product-category").select2("val", "");
        
    });
    
    $( "input[name='find_sub_product']" ).on('keyup',function(){
        
        var search_value = $(this).val();
        var sub_product_ids = $("input[name='sub_product_ids']").val();
        var sub_product_quantities = $("input[name='sub_product_quantities']").val();
        
        $.ajax({
            url:"{{ route('ar.profile.product.quantity.sub.filter', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, search_value:search_value, sub_product_ids:sub_product_ids, sub_product_quantities:sub_product_quantities},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.sub-products-result').html('');
                $('.sub-products-result').html(data.products);
                console.log(data.sub_product_ids)
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
    });    

    $( "select[name='sub_product_category']" ).on('change',function(){
    
        var category_id = $( this ).val();
        var sub_product_ids = $("input[name='sub_product_ids']").val();
        var sub_product_quantities = $("input[name='sub_product_quantities']").val();

        $.ajax({
            url:"{{ route('ar.profile.product.quantity.sub.filter.category', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, category_id:category_id, sub_product_ids:sub_product_ids, sub_product_quantities:sub_product_quantities},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.sub-products-result').html('');
                $('.sub-products-result').html(data.products);
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    
    $( '.sub-products-result' ).on('click', '.choose-sub-product', function(){
    
        var product_id  = $( this ).data( "content" );
        var quantity = $("input[name='sub_product_" + product_id + "']").val();
        
        var current_value = $("input[name='sub_product_ids']").val();
        var current_quantities = $("input[name='sub_product_quantities']").val();
        
        if(current_value.indexOf(product_id) == -1)
        {
            if (current_value === "") current_value += product_id;
            else current_value += ',' + product_id;
            if (current_quantities === "") current_quantities += quantity;
            else current_quantities += ',' + quantity;
            
            $("input[name='sub_product_ids']").val(current_value);
            $("input[name='sub_product_quantities']").val(current_quantities);

            $(this).closest('.p-item').prepend('<div class="check"><i class="fa fa-check"></i></div>');
        }
    }); 
    
    $( '.sub-products-result' ).on('click', '.remove-sub-product', function(){

        var product_id  = $( this ).data( "content" );
        var quantity = $("input[name='sub_product_" + product_id + "']").val();
        
        var current_value = $("input[name='sub_product_ids']").val();
        var current_quantities = $("input[name='sub_product_quantities']").val();
        
        if(current_value.indexOf(product_id) != -1)
        {
            var new_value = current_value.replace(',' + product_id, "");  
            new_value = new_value.replace(product_id + ',', "");  
            new_value = new_value.replace(product_id, ""); 
            
            var new_quantity = current_quantities.replace(',' + quantity, "");  
            new_quantity = new_quantity.replace(quantity + ',', "");  
            new_quantity = new_quantity.replace(quantity, ""); 
            
            $("input[name='sub_product_ids']").val(new_value);
            $("input[name='sub_product_quantities']").val(new_quantity);
            console.log($("input[name='sub_product_ids']").val());
            console.log($("input[name='sub_product_quantities']").val());
            
            $(this).closest('.p-item').find('div').first().remove();

        }
    }); 
    
    $( '.show-all-selected-sub-products' ).on('click',function(){
    
        var sub_product_ids = $("input[name='sub_product_ids']").val();
        var sub_product_quantities = $("input[name='sub_product_quantities']").val();

        $.ajax({
            url:"{{ route('ar.profile.product.quantity.sub.selected', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, sub_product_ids:sub_product_ids, sub_product_quantities:sub_product_quantities},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                console.log(data.current_quantities);
                $('.sub-products-result').html('');
                $('.sub-products-result').html(data.selected_sub_products);
                $("input[name='find_sub_product']").val('');
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    
    $( '.show-all-sub-products' ).on('click',function(){
    
        var sub_product_ids = $("input[name='sub_product_ids']").val();
        var sub_product_quantities = $("input[name='sub_product_quantities']").val();

        $.ajax({
            url:"{{ route('ar.profile.product.quantity.sub.all', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, sub_product_ids:sub_product_ids, sub_product_quantities:sub_product_quantities},
            dataType:'JSON',
            beforeSend: function(){
                //$(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('.sub-products-result').html('');
                $('.sub-products-result').html(data.all_products);
                $("input[name='find_sub_product']").val('');
                //$(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    
    $( '.select-all-sub-products' ).on('click',function(){
    
        var sub_product_ids = $("input[name='sub_product_ids']").val();
        var sub_products_result = $('.sub-products-result').find('.danger');
        $("input[name='sub_product_ids']").val('');
        var current_value = $("input[name='sub_product_ids']").val();
        
        var sub_product_quantities = $("input[name='sub_product_quantities']").val();
        var sub_products_quantities_result = $('.sub-products-result').find('.products-quantity');
        $("input[name='sub_product_quantities']").val('');
        var current_quantities = $("input[name='sub_product_quantities']").val();
        
        sub_products_result.each(function( index ) {
            var product_id = $( this ).data( 'content' );
            
            if(current_value.indexOf(product_id) == -1)
            {
                if (current_value === "") current_value += product_id;
                else current_value += ',' + product_id;
    
                $("input[name='sub_product_ids']").val(current_value);
    
                $(this).closest('.p-item').prepend('<div class="check"><i class="fa fa-check"></i></div>');
            }

        });
        sub_products_quantities_result.each(function( index ) {
            var product_id = $( this ).val();
            console.log(product_id);
            console.log(current_quantities);
            if(current_quantities.indexOf(product_id) == -1)
            {
                if (current_quantities === "") current_quantities += product_id;
                else current_quantities += ',' + product_id;
    
                $("input[name='sub_product_quantities']").val(current_quantities);
    
            }

        });
        console.log($("input[name='sub_product_ids']").val());
        console.log($("input[name='sub_product_quantities']").val());
    });

    $( '.reset-sub-products' ).on('click',function(){
    
        $("input[name='sub_product_ids']").val('');
        $("input[name='sub_product_quantities']").val('');
        $('.sub-products-result').html('');

    });
    
    $('.submit-quantity').on('click', function(){
        if(confirm('Are you sure you want to add this ?'))
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var main_product_ids = $("input[name='main_product_id']").val();
            var sub_product_ids = $("input[name='sub_product_ids']").val();
            var sub_product_quantities = $("input[name='sub_product_quantities']").val();
            
            $.ajax({
                url:"{{ route('ar.profile.product.quantity.add', [Auth::user()->username_tag]) }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, main_product_ids:main_product_ids, sub_product_ids:sub_product_ids, sub_product_quantities:sub_product_quantities},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success:function(data)
                {
                    alert(data.message);
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        } 
    });
    
    $('.image-other-product').on('click', 'a', function(){
        if(confirm('Are you sure you want to Delete ?'))
        {
            var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
            var image_id = $( this ).data( "content" );
            $( this ).html('');
            //console.log(image_id);
            
            $.ajax({
                url:"{{ route('ar.profile.product.image.delete', [Auth::user()->username_tag]) }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, image_id:image_id},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    //console.log(data.result);
                    if(data.result) 
                    {
                        $(' .delete[data-content="' + data.result + '"] ').parent().remove();
                    }
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
        
    });
@endsection
@section('custom-css')
    <style>
    .select2-container{
        width: 100% !important;
        margin-bottom: 10px;
    }
    </style>
@endsection
@section('custom-script')
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<!--<script src="{{asset('/jQuery-File-Upload/js/vendor/jquery.ui.widget.js')}}"></script>-->
<!--<script src="{{asset('/jQuery-File-Upload/js/jquery.iframe-transport.js')}}"></script>-->
<!--<script src="{{asset('/jQuery-File-Upload/js/jquery.fileupload.js')}}"></script>-->
@endsection