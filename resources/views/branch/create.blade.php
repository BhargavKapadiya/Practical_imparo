@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Branch') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <form method="post" action="{{ route('branch.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Selecte Business</label>
                                <select name="business" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($business as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('business'))
                                <span class="text-danger">{{ $errors->first('business') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Selecte Business</label>
                                <select name="days[]" class="form-control js-example-basic-multiple-limit" multiple>
                                    <option value="">Select</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thrusday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                    <option value="7">Sunday</option>
                                </select>
                                @if ($errors->has('days'))
                                    <span class="text-danger">{{ $errors->first('days') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Start Time</label>
                                <input type="time" name="start_time" class="form-control" id="exampleInputPassword1" placeholder="Name">
                                @if ($errors->has('start_time'))
                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                @endif
                            </div>
                             <div class="form-group">
                                <label for="exampleInputPassword1">End Time</label>
                                <input type="time" name="end_time" class="form-control" id="exampleInputPassword1" placeholder="Name">
                                @if ($errors->has('end_time'))
                                <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" name="image[]" class="form-control" id="exampleInputPassword1" accept="image/*" multiple>
                                @if ($errors->has('image'))
                                      <span class="text-danger">{{ $errors->first('image') }}</span>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".js-example-basic-multiple-limit").select2({
        maximumSelectionLength: 5
        });
</script>
@endsection
