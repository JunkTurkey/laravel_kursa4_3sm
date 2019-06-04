@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="container" >
                    <form method="post" action="{{ url('/createAppointment/create') }}" class="card card-body">
                        @csrf
                        Wanted doctor:
                        <select class="form-control col-md-8" name="doctor">
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->user_id->name }}">{{ $doctor->user_id->name }}</option>
                            @endforeach
                        </select>
                        <div style="margin: 2vh 0">
                        Wanted date:
                            <input type="date" name="appointed_at_date" class="col-md-5 form-control">
                            <input type="time" name="appointed_at_time" class="col-md-5 form-control">
                        </div>
                        Appointment type:
                        <select class="form-control col-md-8" name="appointment_type">
                            @foreach($types as $type)
                                <option value="{{ $type->description }}">{{ $type->description }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="col-md-4 form-control" style="margin-top: 2vh">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection