<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Medicament;
use App\Reciept;
use App\Status;
use App\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{

    public function showAppointment($id){
        return view('appointment', [
            'appointment' => Appointment::find($id),
            'reciepts' => Reciept::where('appointment_id', $id)->get(),
            'medicaments' => Medicament::all(),
        ]);
    }

    public function editAppointment(Request $request, $id){
        $symptom = Symptom::firstOrCreate(['indication' => $request->symptom]);
        $i=1;
        while($request->has('medicament_'.$i)){
            $medicaments[$i-1] = $request->get('medicament_'.$i);
            $i++;
        }
        $reciept = new Reciept();
        $reciept->appointment_id = $id;
        $reciept->save();
        $reciept->symptoms()->attach($symptom);
        foreach ($medicaments as $medicament)
            $reciept->medicaments()->attach(Medicament::where(['name' => $medicament])->first());

        return redirect('/showAppointment/'.$id);
    }

    public function editReciept(Request $request, $id){
        $appointment_id = $request->appointment_id;
        $symptom = Symptom::firstOrCreate(['indication' => $request->symptom]);
        $i=1;
        while($request->has('medicament_'.$i)){
            $medicaments[$i-1] = $request->get('medicament_'.$i);
            $i++;
        }
        $reciept = Reciept::find($id);
        $reciept->symptoms()->detach();
        $reciept->symptoms()->attach($symptom);
        $reciept->medicaments()->detach();
        foreach ($medicaments as $medicament)
            $reciept->medicaments()->attach(Medicament::where(['name' => $medicament])->first());

        return redirect('/showAppointment/'.$appointment_id);
    }

    public function deleteAppointment($id){
        Appointment::find($id)->delete();
        return redirect()->back();
    }

    public function acceptAppointment($id){
        $appointment = Appointment::find($id);
        $appointment->status_id = Status::where('name', 'accepted')->first()->id;
        $appointment->save();
        return redirect()->back();
    }

    public function deleteReciept($id){
        $reciept = Reciept::find($id);
        $medicaments = $reciept->medicaments();
        foreach ($medicaments as $medicament)
            $reciept->medicaments()->detach($medicament);
        $symptoms = $reciept->symptoms();
        foreach ($symptoms as $symptom)
            $reciept->symptoms()->detach($symptom);

        $reciept->delete();
        return redirect()->back();
    }
}
