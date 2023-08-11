<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class DashController extends Controller
{
    // Load the dashboard
    public function dashboard(){
        return view('maindash');
    }

    // Load the dashboard (Return patient that was searched for)
    public function searchPatient(Request $request){
        $receivedID = $request->patientID;

        $patients = Patient::where('id_number', 'LIKE', '%'.$receivedID.'%')->get();

        if(empty($patients[0])){
            return redirect('/dashboard')->with('error', 'Could Not Find Patient!');
        } else {
            return redirect('/dashboard')->with('patientList', $patients);
        }
    }

    // Add A New Patient To The Database
    public function addPatient(Request $request){
        // Convert ID and PHONE NO. To INTEGER
        if (is_numeric($request->newIDNumber) && !strpos($request->newIDNumber, '.')) {
            $idInput = ltrim($request->newIDNumber, '+');
            $idInput = (int)$request->newIDNumber;
        } else {
            $idInput = false;
        }
        if (is_numeric($request->newPhone) && !strpos($request->newPhone, '.')) {
            $phoneInput = ltrim($request->newPhone, '+');
            $phoneInput = (int)$request->newPhone;
        } else {
            $phoneInput = false;
        }

        // VALIDATION
            // Check ID Number
        if(!$idInput) {
            return redirect('/dashboard')->with('passwordError', 'Invalid ID, Numbers Only!');
        } else {
            if($idInput < 0){
                return redirect('/dashboard')->with('passwordError', 'Invalid ID, No NEGATIVE Numbers!');
            }
            if(strlen((string)$idInput) < 8 || strlen((string)$idInput) > 8){
                return redirect('/dashboard')->with('passwordError', 'ID Should Be 8 numbers!');
            }
        }

            // Check Names
        if(strlen($request->newFName) > 20){
            return redirect('/dashboard')->with('passwordError', 'First Name Too Long! Use 20 Characters Or Less');
        }
        if(strlen($request->newLName) > 20){
            return redirect('/dashboard')->with('passwordError', 'Last Name Too Long! Use 20 Characters Or Less');
        }

            // Check phone number
        if(!$phoneInput) {
            return redirect('/dashboard')->with('passwordError', 'Invalid Phone, Numbers Only!');
        } else {
            if($phoneInput < 0){
                return redirect('/dashboard')->with('passwordError', 'Invalid Phone, No NEGATIVE Numbers!');
            }
            if(strlen((string)$phoneInput) < 9 || strlen((string)$phoneInput) > 12){
                return redirect('/dashboard')->with('passwordError', 'Phone Number Should Be 9 to 12 numbers!');
            }
        }
        
        try {
            $newPatient = new Patient;

            $newPatient->id_number = $idInput;
            $newPatient->f_name = $request->newFName;
            $newPatient->l_name = $request->newLName;
            $newPatient->sex = $request->newSex;
            $newPatient->date_of_birth = $request->newDOB;
            $newPatient->phone_no = $phoneInput;

            $newPatient->save();

            return redirect('/patientSummary'.'/'.$newPatient->id_number);

        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) { // MySQL error code for duplicate entry
                // Handle the integrity constraint violation error
                return redirect('/dashboard')->with('passwordError', 'Duplicate Entry Detected! ID Already Exists');
            } else {
                // Handle other query exceptions
                return redirect('/dashboard')->with('error', $e->getMessage());
            }
        }
    }

    public function makePrediction(Request $request){
        $finalPrediction = '';
        // STEP 1: Set the API endpoint URL
        $apiUrl = 'http://127.0.0.1:5022/outcomes';
            // Initiate a new cURL session/resource
        $curl = curl_init();

        // STEP 2: Set the values of the parameters to pass to the model
        $arg_fever = $request->arg_fever;
        $arg_cough = $request->arg_cough;
        $arg_fatigue = $request->arg_fatigue;
        $arg_diff_breathing = $request->arg_diff_breathing;
        $arg_age = $request->arg_age;
        $arg_gender = $request->arg_gender;
        $arg_bp = $request->arg_bp;
        $arg_cholesterol_lvl = $request->arg_cholesterol_lvl;

        $params = array(
            'arg_fever' => $arg_fever,
            'arg_cough' => $arg_cough,
            'arg_fatigue' => $arg_fatigue,
            'arg_diff_breathing' => $arg_diff_breathing,
            'arg_age' => $arg_age,
            'arg_gender' => $arg_gender,
            'arg_bp' => $arg_bp,
            'arg_cholesterol_lvl' => $arg_cholesterol_lvl
        );

        // STEP 3: Set the cURL options
        // CURLOPT_RETURNTRANSFER: true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $apiUrl = $apiUrl . '?' . http_build_query($params);
        curl_setopt($curl, CURLOPT_URL, $apiUrl);

        // Make a GET request
        $response = curl_exec($curl);
        // Close cURL session/resource
        curl_close($curl);

        // Decode the JSON into normal text
        $data = json_decode($response, true);

        // Check if the response was successful
        if (isset($data['0'])) {
            // API request was successful
            // Access and Process the data
            foreach($data as $repository) {
                $finalPrediction = ''.$repository['0'].$repository['1'].$repository['2'].'';
            }
            return redirect('/dashboard')->with('predictionData', $finalPrediction);
        } else {
            // API request failed or returned an error
            // Handle the error appropriately
            $finalPrediction = "API Error: " . $data['message'];
            return redirect('/dashboard')->with('predictionData', $finalPrediction);
        }

        return redirect('/dashboard')->with('predictionData', 'nothing happened');
    }
}
