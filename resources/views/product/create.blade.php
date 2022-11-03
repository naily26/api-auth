@extends('layout.master');

@section('content')
    <div class="container">
        <div >
        <div class="content-wrapper">
            <h2>Add New Product</h2><br/>
            <div class="row">
                <div class="card card-primary">
                    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Barang</label>
                                <input type="text" class="form-control" id="name" placeholder="Masukkan nama barang" name="name">
                            </div>
                            <div class="form-group">
                                <label for="price">Harga Barang</label>
                                <input type="number" class="form-control" id="price" placeholder="Masukkan harga barang" name="price">
                            </div>
                            <div class="form-group">
                                <label for="stock">stok Barang</label>
                                <input type="number" class="form-control" id="stock" placeholder="Masukkan stok barang" name="stock">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Barang</label>
                                <input type="text" class="form-control" id="gambar" placeholder="Masukkan link gambar barang" name="gambar">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection