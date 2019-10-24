@extends('master')
@section('content')
    <div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Tìm kiếm</h4>
							<div class="beta-products-details">
								<p class="pull-left">TÌm thấy {{count($product)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($product as $new)
								@php
									$img = $new->image;
								@endphp
								<div class="col-sm-3">
									<div class="single-item">
									@if($new->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="single-item-header">
											<a href="{{route('chitietsanpham',$new->id)}}"><img src="{{Voyager::image($img)}}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$new->name}}</p>
											<p class="single-item-price" style="font-size:18px">
												@if($new->promotion_price==0)
													<span class="flash-sale">{{number_format($new->unit_price)}} đồng</span>
												@else
												<span class="flash-del">{{number_format($new->unit_price)}} đồng</span>
												<span class="flash-sale">{{number_format($new->promotion_price)}} đồng</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>

						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>


					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
        </div> <!-- #content -->
@endsection
