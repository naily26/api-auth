@extends('layout.master')

@section('content')
<div class="container">
    <div >
    <div class="content-wrapper">
        <h2>Edit Product</h2><br/>
        <div class="row">
            <div class="card card-primary">
                <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkan nama barang" value="{{ $product->name }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Harga Barang</label>
                            <input type="number" class="form-control" id="price" placeholder="Masukkan harga barang" value="{{ $product->price }}" name="price">
                        </div>
                        <div class="form-group">
                            <label for="stock">stok Barang</label>
                            <input type="number" class="form-control" id="stock" placeholder="Masukkan stok barang" value="{{ $product->stock }}" name="stock">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Barang</label>
                            <input type="text" class="form-control" id="gambar" placeholder="Masukkan link gambar barang" value="{{ $product->gambar}}" name="gambar">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection