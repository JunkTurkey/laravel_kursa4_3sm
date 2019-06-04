<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Status;

class DoctorController extends Controller
{
    public function closeAppointment($id){
        $appointment = Appointment::find($id);
        $appointment->status_id = Status::where('name', 'closed')->first()->id;
        $appointment->save();
        return redirect('/doctorArea');
    }
}
