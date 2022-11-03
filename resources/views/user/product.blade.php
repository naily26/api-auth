@extends('layout.master')

@section('content')
<section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
        @foreach ($product as $key => $product)
        <div class="col-md-12 col-lg-3 mb-4 mb-lg-0" >
          <div class="card">
            <div class="d-flex justify-content-between p-3">
              <p class="lead mb-0">Today's Combo Offer</p>
              <div
                class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                style="width: 35px; height: 35px;">
                <p class="text-white mb-0 small">x4</p>
              </div>
            </div>
            <a href="{{ route('product.show',['product'=>$product->id]) }}">
            <img src="{{ $product->gambar}}"
              class="card-img-top" alt="Laptop" />
            </a>
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <p class="small"><a href="#!" class="text-muted">Hijab</a></p>
                <p class="small text-danger"><s>{{$product->price+10000}}</s></p>
              </div>
  
              <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0">{{ $product->name}}</h5>
                <h5 class="text-dark mb-0">{{$product->price}}</h5>
              </div>
  
              <div class="d-flex justify-content-between mb-2">
                <p class="text-muted mb-0">Available: <span class="fw-bold">{{ $product->stock}}</span></p>
                <div class="ms-auto text-warning">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection