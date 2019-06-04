@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container" >

                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <td>id</td>
                        <td>email</td>
                        <td>roles</td>
                    </tr>
                    </thead>

                    <?php foreach ($users as $user) : ?>
                    <tr>

                        <td> {{ $user->id }}</td>
                        <td> {{ $user->email }}  </td>
                        <td>{{ implode(", ", $user->roleName()) }}</td>
                        <td><a href="{{ url('/appointAs/'.$user->id) }}" >
                                {{ $user->hasRole('doctor') ? 'Unappoint' : 'Appoint' }} as doctor</a> </td>
                        <td><a href="{{ url('/showUserDetails/'.$user->id) }}">Show details</a> </td>
                    </tr>

                    <?php endforeach; ?>
                </table>
            </div>
            <tr>{{ $users->links() }}</tr>
        </div>
    </div>

</div>
    

@endsection
