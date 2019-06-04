<?php

namespace App\Http\Controllers;

use App\Appointment_type;
use App\Status;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\Doctor;
use DB;
use App\User;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function goToAdminArea(){
        $users = User::paginate(10);
        return view('admin', ['users' => $users]);
    }

    public function goToDoctorArea(){
        $appointments_open = Appointment::where([
            ['doctor_id', Doctor::where('user_id', Auth::user()->id)->first()->id],
            ['status_id', Status::where('name', 'open')->first()->id]
        ])->orderBy('appointed_at', 'asc')->paginate(10);
        $appointments_closed = Appointment::where([
            ['doctor_id', Doctor::where('user_id', Auth::user()->id)->first()->id],
            ['status_id', Status::where('name', 'closed')->first()->id]
        ])->orderBy('appointed_at', 'asc')->paginate(10);
        $appointments_accepted = Appointment::where([
            ['doctor_id', Doctor::where('user_id', Auth::user()->id)->first()->id],
            ['status_id', Status::where('name', 'accepted')->first()->id]
        ])->orderBy('appointed_at', 'desc')->paginate(10);
        return view('doctor', [
            'appointments_open' => $appointments_open,
            'appointments_closed' => $appointments_closed,
            'appointments_accepted' => $appointments_accepted,
        ]);
    }
    public function goToPatientArea(){
        $appointments = Appointment::where('patient_id', User::find(Auth::user()->id)->id)->orderBy('appointed_at', 'desc')->paginate(10);
        return view('patient', ['appointments' => $appointments]);
    }

    public function showUserDetails($id){
        return view('userDetails', ['user' => User::find($id), 'appointments' => Appointment::all()->
            where('patient_id', $id)]);
    }
}
