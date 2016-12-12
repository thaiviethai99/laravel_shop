@extends('user.master')
@section('content')
<div id="maincontainer">
  <section id="product">
    <div class="container">
     <!--  breadcrumb -->  
      <ul class="breadcrumb">
        <li>
          <a href="#">Home</a>
          <span class="divider">/</span>
        </li>
        <li class="active">Category</li>
      </ul>
      <div class="row">        
        <!-- Sidebar Start-->
        <aside class="span3">
         <!-- Category-->  
          <div class="sidewidt">
            <h2 class="heading2"><span>Categories</span></h2>
            <ul class="nav nav-list categories">
            @foreach($menu_cate as $item)
              <li>
                <a href="{!! URL('loai-san-pham',[$item->id,$item->alias]) !!}">{{$item->name}}</a>
              </li>
            @endforeach
            </ul>
          </div>
         <!--  Best Seller -->  
          <div class="sidewidt">
            <h2 class="heading2"><span>Best Seller</span></h2>
            <ul class="bestseller">
              <li>
                <img width="50" height="50" src="img/prodcut-40x40.jpg" alt="product" title="product">
                <a class="productname" href="product.html"> Product Name</a>
                <span class="procategory">Women Accessories</span>
                <span class="price">$250</span>
              </li>
              <li>
                <img width="50" height="50" src="img/prodcut-40x40.jpg" alt="product" title="product">
                <a class="productname" href="product.html"> Product Name</a>
                <span class="procategory">Electronics</span>
                <span class="price">$250</span>
              </li>
              <li>
                <img width="50" height="50" src="img/prodcut-40x40.jpg" alt="product" title="product">
                <a class="productname" href="product.html"> Product Name</a>
                <span class="procategory">Electronics</span>
                <span class="price">$250</span>
              </li>
            </ul>
          </div>
          <!-- Latest Product -->  
          <div class="sidewidt">
            <h2 class="heading2"><span>Latest Products</span></h2>
            <ul class="bestseller">
            @foreach($lasted_product as $item)
              <li>
                <img width="50" height="50" src="{{asset('public/uploads/images/small_thumb_'.$item->image)}}" alt="product" title="product">
                <a class="productname" href="{{url('chi-tiet-san-pham',[$item->id,$item->alias])}}">{{$item->name}}</a>
                <?php 
                $cate = DB::table('cates')->select('name')->where('id',$item->cate_id)->first();
                ?>
                <span class="procategory">{{$cate->name}}</span>
                <span class="price">{{Helper::product_price($item->price)}}</span>
              </li>
            @endforeach
            </ul>
          </div>
          <!--  Must have -->  
          <div class="sidewidt">
          <h2 class="heading2"><span>Must have</span></h2>
          <div class="flexslider" id="mainslider">
            <ul class="slides">
              <li>
                <img src="img/product1.jpg" alt="" />
              </li>
              <li>
                <img src="img/product2.jpg" alt="" />
              </li>
            </ul>
          </div>
          </div>
        </aside>
        <!-- Sidebar End-->
        <!-- Category-->
        <div class="span9">
          <!-- Category Products-->
          <section id="category">
            <div class="row">
              <div class="span9">
               <!-- Category-->
                <section id="categorygrid">
                  <ul class="thumbnails grid">
                  @foreach($product_cate as $item)
                    <li class="span3">
                      <a class="prdocutname" href="{{url('chi-tiet-san-pham',[$item->id,$item->alias])}}">{{$item->name}}</a>
                      <div class="thumbnail">
                        <span class="sale tooltip-test">Sale</span>
                        <a href="{{url('chi-tiet-san-pham',[$item->id,$item->alias])}}"><img alt="" src="{{asset('public/uploads/images/thumb_'.$item->image)}}"></a>
                        <div class="pricetag">
                          <span class="spiral"></span><a href="#" class="productcart">ADD TO CART</a>
                          <div class="price">
                            <div class="pricenew">{{Helper::product_price($item->price)}}</div>
                            <div class="priceold"></div>
                          </div>
                        </div>
                      </div>
                    </li>
                  @endforeach
                  </ul>
                  Tong so trang {!!$product_cate->lastPage()!!}
                  <div class="pagination pull-right">
                    <ul>
                    @if($product_cate->currentPage()!=1)
                      <li><a href="{{$product_cate->url($product_cate->currentPage()-1)}}">Prev</a>
                      </li>
                    @endif
                      @for($i=1;$i<=$product_cate->lastPage();$i++)
                      <li class="{{($product_cate->currentPage()==$i)?'active':''}}">
                        <a href="{{$product_cate->url($i)}}">{{$i}}</a>
                      </li>
                      @endfor
                      @if($product_cate->currentPage()!=$product_cate->lastPage())
                      <li><a href="{{$product_cate->url($product_cate->currentPage()+1)}}">Next</a>
                      </li>
                      @endif
                    </ul>
                  </div>
                </section>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection