@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Bussiness') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <form method="post" action="{{ route('home.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" class="form-control" id="exampleInputPassword1" placeholder="Name" value="{{ $data->id }}">
                            <div class="form-group">
                              <label for="exampleInputPassword1">Name</label>
                              <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name" value="{{ $data->name }}">
                              @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $data->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                @php
                                  $url = url('/uploads/logo').'/'.$data->logo;
                                  @endphp
                              <img src="{{$url}}" width="100" height="100"><br>
                              <label for="exampleInputPassword1">Logo</label>
                              <input type="file" name="logo" class="form-control" id="exampleInputPassword1" accept="image/*">
                              @if ($errors->has('logo'))
                                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
