@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container" >
                    <ul class="nav nav-tabs nav-justified">
                        <li ><a data-toggle="tab" class="nav-link active" href="#opened">Opened</a></li>
                        <li ><a data-toggle="tab" class="nav-link" href="#accepted">Accepted</a></li>
                        <li ><a data-toggle="tab" class="nav-link" href="#closed">Closed</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="opened" class="tab-pane active">
                            <table class="table table-hover active">
                                <thead class="thead-light">
                                <tr>
                                    <td>id</td>
                                    <td>patient</td>
                                    <td>appointed at</td>
                                    <td>type</td>
                                </tr>
                                </thead>
                                <?php foreach ($appointments_open as $appointment) : ?>
                                <tr>
                                    <td> {{ $appointment->id }}</td>
                                    <td> {{ $appointment->patient_id->name }} </td>
                                    <td> {{ $appointment->appointed_at }} </td>
                                    <td> {{ $appointment->appointment_type_id->description }}</td>
                                    <td> <a href="{{ url('/acceptAppointment/'.$appointment->id) }}">accept</a> </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            <tr>{{ $appointments_open->links() }}</tr>
                        </div>
                        <div id="accepted" class="tab-pane fade">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <td>id</td>
                                    <td>patient</td>
                                    <td>appointed at</td>
                                    <td>type</td>
                                </tr>
                                </thead>
                                <?php foreach ($appointments_accepted as $appointment) : ?>
                                <tr>
                                    <td> {{ $appointment->id }}</td>
                                    <td> {{ $appointment->patient_id->name }} </td>
                                    <td> {{ $appointment->appointed_at }} </td>
                                    <td> {{ $appointment->appointment_type_id->description }}</td>
                                    <td> <a href="{{ url('/showAppointment/'.$appointment->id) }}">show</a> </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            <tr>{{ $appointments_accepted->links() }}</tr>
                        </div>
                        <div id="closed" class="tab-pane fade">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <td>id</td>
                                    <td>patient</td>
                                    <td>appointed at</td>
                                    <td>type</td>
                                </tr>
                                </thead>
                                <?php foreach ($appointments_closed as $appointment) : ?>
                                <tr>
                                    <td> {{ $appointment->id }}</td>
                                    <td> {{ $appointment->patient_id->name }} </td>
                                    <td> {{ $appointment->appointed_at }} </td>
                                    <td> {{ $appointment->appointment_type_id->description }}</td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            <tr>{{ $appointments_closed->links() }}</tr>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection
