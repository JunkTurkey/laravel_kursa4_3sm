<?php

namespace App\Http\Controllers;

use App\Appointment_type;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use App\Doctor;
use App\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PatientController extends Controller
{

    public function createAppointment(){
        return view('appointmentCreation', [
            'doctors' => Doctor::all(),
            'types' => Appointment_type::all(),
        ]);
    }

    public function create(Request $request){
        $appointment = new Appointment();
        $appointment->doctor_id = Doctor::find(User::where('name', $request->doctor)->first()->id)->id-1;
        $appointment->appointed_at = $request->appointed_at_date.' '.$request->appointed_at_time;
        $appointment->patient_id = Auth::id();
        $appointment->status_id = Status::where('name', 'open')->first()->id;
        $appointment->appointment_type_id = Appointment_type::where('description', $request->appointment_type)->first()->id;
        $appointment->save();
        return redirect('/patientArea');
    }
}
