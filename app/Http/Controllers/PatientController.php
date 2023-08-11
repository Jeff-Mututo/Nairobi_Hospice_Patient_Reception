<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Allergy;
use App\Models\Document;
use App\Models\Symptom;
use App\Models\Prescription;
use App\Models\Note;

class PatientController extends Controller
{
    // Load the patient summary of the specified Patient with corresponding ID Number
    public function patientSummary($id_number){
        $currPatient = Patient::where('id_number', $id_number)->first();

        if(!empty($currPatient)){
            $currPatientAllergies = Allergy::where('patient_id', $currPatient->id)->get();
            $currPatientSymptoms = Symptom::where('patient_id', $currPatient->id)->get();
            $currPatientPrescriptions = Prescription::where('patient_id', $currPatient->id)->get();
            $currPatientNotes = Note::where('patient_id', $currPatient->id)->latest()->take(5)->get();

            return view('patientsummary')
                ->with('patient', $currPatient)
                ->with('allergies', $currPatientAllergies)
                ->with('symptoms', $currPatientSymptoms)
                ->with('prescriptions', $currPatientPrescriptions)
                ->with('notes', $currPatientNotes);
        } else {
            return redirect('/dashboard')->with('error', 'Could Not Find Patient!');
        }
    }

    // ======================================================================================
    // LEFT HAND PANEL
    // ======================================================================================

    // Add a new ALLERGY to a specific patient
    public function addAllergy(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $newAllergy = new Allergy;
            $newAllergy->patient_id = $request->currPatient;
            $newAllergy->allergy_name = $request->allergy_name;
            $newAllergy->severity = $request->severity;

            $newAllergy->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // Delete A Specified ALLERGY
    public function deleteAllergy(Request $request, $id){
        $currPatient = Patient::find($request->currPatient);
        $currAllergy = Allergy::find($id);

        if(is_null($currAllergy)){
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Could Not Find Allergy!');
        } else {
            $currAllergy->delete();
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Allergy DELETED!');
        }
    }

    // ======================================================================================
    // UPDATE PATIENT DATA
    // ======================================================================================

    // UPDATE the LAST NAME of the current Patient
    public function updateLName(Request $request){
        try {
            if(strlen($request->l_name) > 20){
                return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Last Name Too Long! Use 20 Characters Or Less');
            }

            $currPatient = Patient::find($request->currPatient);

            $currPatient->l_name = $request->l_name;

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // UPDATE the FIRST NAME of the current Patient
    public function updateFName(Request $request){
        try {
            if(strlen($request->f_name) > 20){
                return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'First Name Too Long! Use 20 Characters Or Less');
            }

            $currPatient = Patient::find($request->currPatient);

            $currPatient->f_name = $request->f_name;

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
            
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // UPDATE the DATE OF BIRTH of the current Patient
    public function updateDOB(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $currPatient->date_of_birth = $request->date_of_birth;

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // UPDATE the HEIGHT of the current Patient
    public function updateHeight(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $currPatient->height = $request->height;

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // UPDATE the WEIGHT of the current Patient
    public function updateWeight(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $currPatient->weight = $request->weight;

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // UPDATE the HEIGHT of the current Patient
    public function updatePhone(Request $request){
        try {
            // CONVERT TO INT
            if (is_numeric($request->phone_no) && !strpos($request->phone_no, '.')) {
                $phoneInput = ltrim($request->phone_no, '+');
                $phoneInput = (int)$request->phone_no;
            } else {
                $phoneInput = false;
            }

            // Get the CURRENT PATIENT
            $currPatient = Patient::find($request->currPatient);

            // VALIDATION
            if(!$phoneInput) {
                return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Invalid Phone, Numbers Only!');
            } else {
                if($phoneInput < 0){
                    return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Invalid Phone, No NEGATIVE Numbers!');
                }
                if(strlen((string)$phoneInput) < 9 || strlen((string)$phoneInput) > 12){
                    return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Phone Number Should Be 9 to 12 numbers!');
                }
            }

            $currPatient->phone_no = $request->phone_no;

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // UPDATE the ADDRESS of the current Patient
    public function updateAddress(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $currPatient->address = $request->patientAddress;

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // UPDATE the ACTIVATION STATUS of the current Patient
    public function toggleActivation(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            if($currPatient->is_active == 1){
                $currPatient->is_active = 0;
            } else {
                $currPatient->is_active = 1;
            }

            $currPatient->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // DELETE the current PATIENT
    public function deletePatient(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $currPatient->delete();
            
            return redirect('/dashboard')->with('error', 'PATIENT DELETED!');
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // ======================================================================================
    // RIGHT HAND PANEL
    // ======================================================================================

    // Add a new FILE to a specific patient
    public function addFile(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $file = $request->file("patient_file");
            $destination = "uploads";

            if($file->move($destination, $file->getClientOriginalName())){
                $newDocument = new Document;
                $newDocument->file_name = $file->getClientOriginalName();
                $newDocument->file_description = $request->file_description;
                $newDocument->file_location = $file->getRealPath();

                $newDocument->save();

                return redirect('/patientSummary'.'/'.$currPatient->id_number);
            } else {
                return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'File Upload Failed');
            }
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // Delete A Specified FILE
    public function deleteFile(Request $request, $id){
        $currPatient = Patient::find($request->currPatient);
        $currFile = Document::find($id);

        if(is_null($currFile)){
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Could Not Find File!');
        } else {
            $currFile->delete();
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'File DELETED!');
        }
    }

    // Add a new SYMPTOM to a specific patient
    public function addSymptom(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $newSymptom = new Symptom;
            $newSymptom->patient_id = $request->currPatient;
            $newSymptom->body_part = $request->body_part;
            $newSymptom->ailment = $request->ailment;
            $newSymptom->severity = $request->severity;

            $newSymptom->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // Delete A Specified SYMPTOM
    public function deleteSymptom(Request $request, $id){
        $currPatient = Patient::find($request->currPatient);
        $currSymptom = Symptom::find($id);

        if(is_null($currSymptom)){
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Could Not Find Symptom!');
        } else {
            $currSymptom->delete();
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Symptom DELETED!');
        }
    }

    // Add a new PRESCRIPTION to a specific patient
    public function addPrescription(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);

            $newPrescription = new Prescription;
            $newPrescription->patient_id = $request->currPatient;
            $newPrescription->brand_name = $request->brand_name;
            $newPrescription->generic_name = $request->generic_name;
            $newPrescription->strength = $request->strength;
            $newPrescription->date_prescribed = $request->date_prescribed;

            $newPrescription->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // Delete A Specified PRESCRIPTION
    public function deletePrescription(Request $request, $id){
        $currPatient = Patient::find($request->currPatient);
        $currPrescription = Prescription::find($id);

        if(is_null($currPrescription)){
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Could Not Find Prescription!');
        } else {
            $currPrescription->delete();
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Prescription DELETED!');
        }
    }

    // Add a new NOTE to a specific patient
    public function addNote(Request $request){
        try {
            $currPatient = Patient::find($request->currPatient);
            $currUser = Auth::user()->name;

            $newNote = new Note;
            $newNote->patient_id = $request->currPatient;
            $newNote->author = $currUser;
            $newNote->note_body = $request->note_body;

            $newNote->save();

            return redirect('/patientSummary'.'/'.$currPatient->id_number);
        } catch (QueryException $e) {
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', $e->getMessage());
        }
    }

    // Delete A Specified NOTE
    public function deleteNote(Request $request, $id){
        $currPatient = Patient::find($request->currPatient);
        $currNote = Note::find($id);

        if(is_null($currNote)){
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Could Not Find Note!');
        } else {
            $currNote->delete();
            return redirect('/patientSummary'.'/'.$currPatient->id_number)->with('error', 'Note DELETED!');
        }
    }
}
