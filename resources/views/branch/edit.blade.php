@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Branch') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <form method="post" action="{{ route('branch.update') }}" enctype="multipart/form-data">
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
                                <label for="exampleInputPassword1">Selecte Business</label>
                                <select name="business" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($business as $b)
                                        <option value="{{ $b->id }}" {{ ($data->business_id == $b->id)?'selected':'' }}>{{ $b->name }}</option>
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
                                    <option value="1" {{ (in_array(1,explode(",",$data->working_days)))?'selected':'' }}>Monday</option>
                                    <option value="2" {{ (in_array(2,explode(",",$data->working_days)))?'selected':'' }}>Tuesday</option>
                                    <option value="3" {{ (in_array(3,explode(",",$data->working_days)))?'selected':'' }}>Wednesday</option>
                                    <option value="4" {{ (in_array(4,explode(",",$data->working_days)))?'selected':'' }}>Thrusday</option>
                                    <option value="5" {{ (in_array(5,explode(",",$data->working_days)))?'selected':'' }}>Friday</option>
                                    <option value="6" {{ (in_array(6,explode(",",$data->working_days)))?'selected':'' }}>Saturday</option>
                                    <option value="7" {{ (in_array(7,explode(",",$data->working_days)))?'selected':'' }}>Sunday</option>
                                </select>
                                @if ($errors->has('days'))
                                    <span class="text-danger">{{ $errors->first('days') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Start Time</label>
                                <input type="time" name="start_time" class="form-control" id="exampleInputPassword1" placeholder="Name" value="{{ date('H:i:s',strtotime($data->working_hrs)) }}">
                                @if ($errors->has('start_time'))
                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                @endif
                            </div>
                             <div class="form-group">
                                <label for="exampleInputPassword1">End Time</label>
                                <input type="time" name="end_time" class="form-control" id="exampleInputPassword1" placeholder="Name" value="{{ date('H:i:s',strtotime($data->end_time)) }}">
                                @if ($errors->has('end_time'))
                                <span class="text-danger">{{ $errors->first('end_time') }}</span>
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
