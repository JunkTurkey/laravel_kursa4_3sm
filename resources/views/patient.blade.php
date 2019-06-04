@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container" >

                    <a href="{{ url('/createAppointment/') }}" class="btn btn-dark" style="margin-bottom: 2vh">Create appointment</a>

                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <td>id</td>
                            <td>FIO</td>
                            <td>appointed at</td>
                            <td>type</td>
                            <td>status</td>
                        </tr>
                        </thead>
                    <?php foreach ($appointments as $appointment) : ?>
                        <tr>
                            <td> {{ $appointment->id }}</td>
                            <td> {{ $appointment->doctor_id->user_id->name }} </td>
                            <td> {{ $appointment->appointed_at }} </td>
                            <td> {{ $appointment->appointment_type_id->description }}</td>
                            <td> {{ $appointment->status_id->name }} </td>
                            <td> <a href="{{ url('/showAppointment/'.$appointment->id) }}">show</a> </td>
                            <td><a onclick="return confirm('Are you sure?')"
                                   href="{{ url('/deleteAppointment/'.$appointment->id) }}"
                                   style="color: red">delete</a> </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <tr>{{ $appointments->links() }}</tr>
            </div>
        </div>

    </div>
@endsection
