@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container" >
                    <div class="row justify-content-between" style="margin: 5vh 0;">
                        <a href=" {{ Auth::user()->hasRole('doctor') ? '/doctorArea' : '/patientArea' }}" >back</a>
                        @if ($reciepts != null && Auth::user()->hasRole('doctor'))
                            <a href="{{ url('/closeAppointment/'.$appointment->id) }}" class="btn btn-dark ">close appointment</a>
                        @endif
                    </div>
                        <div class="row" id="info">
                            <div class="col-md-6">
                                <div>patient: {{ $appointment->patient_id->name }}</div>
                                <div>appointed at: {{ $appointment->appointed_at }}</div>
                                <div>status: {{ $appointment->status_id->name }}</div>
                                <div>type: {{ $appointment->appointment_type_id->description }}</div>
                            </div>
                            <div class="col-md-6">
                                <div>doctor: {{ $appointment->doctor_id->user_id->name }}</div>
                                <div>cabinet number: {{ $appointment->doctor_id->cabinet_id->number }}</div>
                                <div>doctor's speciality: {{ $appointment->doctor_id->speciality_id->name }}</div>
                                <div>phone: {{ $appointment->doctor_id->phone }}</div>
                            </div>
                        </div>
                </div>

                @if ($reciepts != null && !Auth::user()->hasRole('doctor'))
                        <?php $i=0 ?>
                        <div class="container ">
                            @foreach($reciepts as $reciept)
                                <button onclick="{{ 'showReciept('.$reciept->id.')' }}" class="form-control">Show reciept</button>
                                <div class="row" style="display: none" id="{{ 'reciept_'.$reciept->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-md-12">Reciept {{++$i}}</div>
                                            @foreach($reciept->symptoms()->get() as $symptom)
                                                <div class="col-md-6">symptom:
                                                    <input disabled name="symptom" class="form-control" value="{{ $symptom->indication }}">
                                                </div>
                                            @endforeach

                                            <div id="{{ $reciept->id }}" class="col-md-12">
                                                <?php $j=0 ?>
                                                    <div class="col-md-12">recomended medicaments:</div>
                                                @foreach($reciept->medicaments()->get() as $medicament)

                                                    <select disabled name="{{ 'medicament_'.++$j }}" class="form-control" style="margin-top: 2vh">
                                                        @foreach($medicaments as $med)
                                                            @if($med->name == $medicament->name)
                                                                <option selected value="{{ $med->name }}">{{ $med->name }}</option>
                                                            @else
                                                                <option value="{{ $med->name }}">{{ $med->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                @endif
                @if ($reciepts != null && Auth::user()->hasRole('doctor'))
                    <?php $i=0 ?>
                    <div class="container" style="margin: 4vh 0">
                            @foreach($reciepts as $reciept)
                                <div style="margin: 1.5vh 0">
                                <button onclick="{{ 'showReciept('.$reciept->id.')' }}" class="form-control">Show reciept {{++$i}}</button>
                                <div class="row" style="display: none" id="{{ 'reciept_'.$reciept->id }}">
                                    <form method="post" class="card" action="{{ url('/editReciept/'.$reciept->id) }}">
                                    @csrf
                                        <div class="card-body">
                                            @foreach($reciept->symptoms()->get() as $symptom)
                                                <div class="col-md-6">symptom:
                                                    <input name="symptom" class="form-control" value="{{ $symptom->indication }}">
                                                </div>
                                            @endforeach
                                            <div class="row" style="margin: 2vh 0 1vh">
                                                <button type="button" onclick="{{ 'addMoreMedicaments('.$reciept->id.')' }}" class="form-control col-md-3" >add medicament</button>
                                                <button type="button" onclick="{{ 'removeSomeMedicaments('.$reciept->id.')' }}" class="form-control col-md-3">remove medicament</button>
                                            </div>
                                            <div id="{{ $reciept->id }}" class="col-md-12">
                                                <?php $j=0 ?>
                                            @foreach($reciept->medicaments()->get() as $medicament)
                                                    <select name="{{ 'medicament_'.++$j }}" class="form-control" >
                                                        @foreach($medicaments as $med)
                                                            @if($med->name == $medicament->name)
                                                                <option selected value="{{ $med->name }}">{{ $med->name }}</option>
                                                            @else
                                                                <option value="{{ $med->name }}">{{ $med->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                            @endforeach
                                            </div>
                                        </div>
                                        <input type="text" style="display: none" name="appointment_id" value="{{ $appointment->id }}">
                                        <div class="row justify-content-between" style="margin: 0">
                                        <button type="submit" class="form-control col-md-6 alert-success">Save</button>
                                        <a class="btn form-control col-md-6 alert-danger" href="{{ url('/deleteReciept/'.$reciept->id) }}">Delete</a>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            @endforeach
                    </div>
                @endif
                <div class="container">
                    @if(Auth::user()->hasRole('doctor'))
                        <form method="POST" action="{{ url('/editAppointment/'.$appointment->id) }}">
                            @csrf
                            <button type="button" class="btn btn-dark" onclick="addReciept()" style="margin: 2vh 0">add reciept</button>
                            <div class="row" id="doctor"></div>

                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection

<script type="text/javascript">
    var medicamentsList1 = @json($medicaments);
    var medicamentsCount;

    function addReciept() {
        window.medicamentsCount = 0;
        var container = document.getElementById("doctor");
        while(container.firstChild)
            container.removeChild(container.firstChild);

        var card = document.createElement("div");
        card.className += " card";
        container.appendChild(card);

        var reciepts = document.createElement("div");
        card.className += " card-body";
        reciepts.id = "reciepts";
        card.appendChild(reciepts);

        var input = document.createElement("input");
        input.type = "input";
        input.name = "symptom";
        input.className += " form-control";
        reciepts.appendChild(input);
        reciepts.appendChild(document.createElement("br"));

        var addMedicament = document.createElement("button");
        addMedicament.textContent = "add medicament";
        addMedicament.type = "button";
        addMedicament.addEventListener("click", addMedicamentsListener);
        addMedicament.classBody += " btn";
        reciepts.appendChild(addMedicament);

        var removeMedicament = document.createElement("button");
        removeMedicament.textContent = "remove medicament";
        removeMedicament.type = "button";
        removeMedicament.addEventListener("click", removeMedicamentsListener);
        removeMedicament.classBody += " btn";
        reciepts.appendChild(removeMedicament);

        var medicamentDiv = document.createElement("div");
        medicamentDiv.id = "medicamentDiv";
        reciepts.appendChild(medicamentDiv);

        var select = document.createElement("select");
        select.className += " form-control";
        window.medicamentsCount++;
        medicamentsList1.forEach(function (element) {
            var opt = document.createElement('option');
            opt.appendChild( document.createTextNode(element.name) );
            opt.value = element.name;
            select.appendChild(opt);
        });
        select.name = "medicament_" + window.medicamentsCount;
        select.value = select.selectedIndex;
        medicamentDiv.appendChild(select);

        var submit = document.createElement("button");
        submit.type = "submit";
        submit.className += " form-control";
        submit.textContent = "save"
        container.appendChild(submit);
    }

    function addMedicamentsListener() {
        var medicaments = document.getElementById("medicamentDiv");
        var select = document.createElement("select");
        select.className += " form-control";
        window.medicamentsList1.forEach(function (element) {
            var opt = document.createElement('option');
            opt.appendChild( document.createTextNode(element.name) );
            opt.value = element.name;
            select.appendChild(opt);
        });
        window.medicamentsCount++;
        select.name = "medicament_" + window.medicamentsCount;
        select.value = select.selectedIndex;
        medicaments.appendChild(select);
    }

    function removeMedicamentsListener() {
        var container = document.getElementById("medicamentDiv")
        container.removeChild(container.lastChild);
    }

    function addMoreMedicaments(id) {
        var medicaments = document.getElementById(id);
        var select = document.createElement("select");
        select.className += " form-control";
        window.medicamentsList1.forEach(function (element) {
            var opt = document.createElement('option');
            opt.appendChild( document.createTextNode(element.name) );
            opt.value = element.name;
            select.appendChild(opt);
        });
        window.medicamentsCount++;
        select.name = "medicament_" + window.medicamentsCount;
        select.value = select.selectedIndex;
        medicaments.appendChild(select);
    }

    function removeSomeMedicaments(id) {
        var container = document.getElementById(id);
        container.removeChild(container.lastChild);
    }

    function showReciept(id) {
        document.getElementById("reciept_"+id).style.display =
            (document.getElementById("reciept_"+id).style.display == "none" ? 'block' : 'none');
    }
</script>