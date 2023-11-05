@extends('dashboard')
@section('content')
<div class="content-header">
    <div class="container-fluid"> <div class="row mb-2"> <div class="col-sm6"> 
        <h1 class="m-0">Tambah Ticket</h1> 
        </div>
        <!-- /.col --> 
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right"> 
        <li class="breadcrumb-item"> 
            <a href="#">Ticket</a>
        </li>
        <li class="breadcrumb-item active">Create</li>
        </ol>
        </div>
        <!-- /.col -->
        </div> 
        <!-- /.row --> 
    </div>
    <!-- /.container-fluid -->
</div> 
<!-- /.content-header --> 
    <!-- Main content --> 
<div class="content">
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-12">
                <div class="card"> 
                    <div class="card-body"> 
                        <form action="{{ route('ticket.store') }}" method="POST"
                        enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-row">
                            </div>  
                            <div class="form-row">
                                <div class="form-group col-md-6"> 
                                    <label class="font-weight-bold">Class</label> 
                                    <input type="text" class="form-control @error('class') is-invalid @enderror" 
                                    name="class" value="{{ old('class') }}" placeholder="Masukkan Nama Ticket" required>
                                    @error('class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" 
                                    name="price" value="{{ old('price') }}" placeholder="Masukkan Price" required>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold" for="movie">Movie</label>
                                    <select class="form-select @error('movie') is-invalid @enderror" 
                                    name="movie" id="movie" required>
                                        <option value="" selected disabled>Pilih Movie</option>
                                        @forelse ($movie as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('movie')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection