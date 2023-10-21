@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Open Day and time') }}
                        <a href="{{ route('branch.index') }}" class="btn btn-primary">Go to Branch</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="panel-body">
                            <div id="msg">{{ view('partials/flash_message') }}</div>
                            <div class="panel panel-flat">
                                <table class="table table-bordered data-table" id="mytable">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>End time</th>
                                        </tr>
                                    </thead>
                                    @foreach (explode(',', $data->working_days) as $day)
                                        <tbody>
                                            @if ($day == 1)
                                                <td>Monday</td>
                                            @endif
                                            @if ($day == 2)
                                                <td>Tuesday</td>
                                            @endif
                                            @if ($day == 3)
                                                <td>Wednesday</td>
                                            @endif
                                            @if ($day == 4)
                                                <td>Thrusday</td>
                                            @endif
                                            @if ($day == 5)
                                                <td>Friday</td>
                                            @endif
                                            @if ($day == 6)
                                                <td>Saturday</td>
                                            @endif
                                            @if ($day == 7)
                                                <td>Sunday</td>
                                            @endif
                                            <td>{{ date('H:i:s',strtotime($data->working_hrs)) }}</td>
                                            <td>{{ date('H:i:s',strtotime($data->end_time)) }}</td>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
