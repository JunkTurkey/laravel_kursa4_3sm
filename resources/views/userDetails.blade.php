@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container" >
                    <div>FIO: {{ $user->name }}</div>
                    <div>E-mail: {{ $user->email }}</div>
                </div>
                <br><br>
                <div class="container" >
                    Your appointments:
                    <table class="table table-hover">
                        <thead class="thead-light">
                        <tr>
                            <td>Doctor</td>
                            <td>Date and Time</td>
                            <td>Status</td>
                        </tr>
                        </thead>
                            <?php foreach ($appointments as $appointment) : ?>
                        <tr>
                            <td>{{ $appointment->doctor_id->user_id->name }}</td>
                            <td>{{ $appointment->appointed_at }}</td>
                            <td>{{ $appointment->status_id->name }}</td>
                        </tr>
                            <?php  endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection