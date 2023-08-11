<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Appointment;
use App\Models\EmpSat;
use App\Models\EmpUnd;
use App\Models\Shift;

class KPIController extends Controller
{
    public function kpidash(){
        // STATISTICS BANNER
        $avgEmpSat = $this->avgEmployeeSatisfaction();
        $avgPatSat = $this->avgPatientSatisfaction();
        $avgTimeWPatients = $this->avgTimeWithPatients();
        $avgGAExpenses = $this->avgGAExpenses();

        // KPI DATA
        $kpiOneAData = $this->kpiOneAData();
        $kpiOneBData = $this->kpiOneBData();
        $kpiTwoAData = $this->kpiTwoAData();
        // $kpiTwoBData = $this->kpiTwoBData();
        $kpiThreeAData = $this->kpiThreeAData();
        $kpiThreeBData = $this->kpiThreeBData();
        $kpiFourAData = $this->kpiFourAData();
        // $kpiFourBData = $this->kpiFourBData();

        return view('kpidash')
            // STATISTICS BANNER
            ->with('avgEmpSat', $avgEmpSat)
            ->with('avgPatSat', $avgPatSat)
            ->with('avgTimeWPatients', $avgTimeWPatients)
            ->with('avgGAExpenses', $avgGAExpenses)
            // KPI DATA
            ->with('kpiOneAData', $kpiOneAData)
            ->with('kpiOneBData', $kpiOneBData)
            ->with('kpiTwoAData', $kpiTwoAData)
            ->with('kpiThreeAData', $kpiThreeAData)
            ->with('kpiThreeBData', $kpiThreeBData)
            ->with('kpiFourAData', $kpiFourAData);
    }

    // =======================================================
    // STATISTICS BANNER FUNCTIONS
    // =======================================================
    private function avgEmployeeSatisfaction(){
        $emp_sat_vals = EmpSat::all();
        $total = 0;
        $count = 0;

        foreach($emp_sat_vals as $val){
            $total = $total + $val->satisfaction_score_2018;
            $total = $total + $val->satisfaction_score_2019;
            $total = $total + $val->satisfaction_score_2020;
            $total = $total + $val->satisfaction_score_2021;
            $total = $total + $val->satisfaction_score_2022;
            $count = $count + 5;
        }

        $finalValue = round($total / $count, 1);

        return $finalValue;
    }

    private function avgPatientSatisfaction(){
        $appointment_values = Appointment::all();
        $arr_size = count($appointment_values);
        $total = 0;

        foreach($appointment_values as $value){
            $total = $total + $value->patient_satisfaction;
        }

        $finalValue = round($total / $arr_size, 1);

        return $finalValue;
    }

    private function avgTimeWithPatients(){
        $appointment_values = Appointment::all();
        $arr_size = count($appointment_values);
        $total = 0;

        foreach($appointment_values as $value){
            $total = $total + $value->appointment_time;
        }

        $finalValue = round($total / $arr_size, 1);

        return $finalValue;
    }

    private function avgGAExpenses(){
        $expense_values = Expense::all();
        $arr_size = count($expense_values);
        $total = 0;

        foreach($expense_values as $value){
            $total = $total + $value->total_expenses;
        }

        $finalValue = round($total / $arr_size, 2);

        return $finalValue;
    }

    // =======================================================
    // KPI 1 FUNCTIONS
    // =======================================================
    private function kpiOneAData() {
        $kpidata = array();
        $emp_und_val = EmpUnd::all();

        // 2018
        $total = 0;
        $count = 0;
        foreach($emp_und_val as $val){
            $total = $total + $val->understanding_score_2018;
            $count = $count + 1;
    
            $finalValue18 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue18);

        // 2019
        $total = 0;
        $count = 0;
        foreach($emp_und_val as $val){
            $total = $total + $val->understanding_score_2019;
            $count = $count + 1;
    
            $finalValue19 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue19);

        // 2020
        $total = 0;
        $count = 0;
        foreach($emp_und_val as $val){
            $total = $total + $val->understanding_score_2020;
            $count = $count + 1;
    
            $finalValue20 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue20);

        // 2021
        $total = 0;
        $count = 0;
        foreach($emp_und_val as $val){
            $total = $total + $val->understanding_score_2021;
            $count = $count + 1;
    
            $finalValue21 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue21);

        // 2022
        $total = 0;
        $count = 0;
        foreach($emp_und_val as $val){
            $total = $total + $val->understanding_score_2022;
            $count = $count + 1;
    
            $finalValue22 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue22);

        return $kpidata;
    }

    private function kpiOneBData() {
        $kpidata = array();
        $emp_sat_val = EmpSat::all();

        // 2018
        $total = 0;
        $count = 0;
        foreach($emp_sat_val as $val){
            $total = $total + $val->satisfaction_score_2018;
            $count = $count + 1;
    
            $finalValue18 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue18);

        // 2019
        $total = 0;
        $count = 0;
        foreach($emp_sat_val as $val){
            $total = $total + $val->satisfaction_score_2019;
            $count = $count + 1;
    
            $finalValue19 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue19);

        // 2020
        $total = 0;
        $count = 0;
        foreach($emp_sat_val as $val){
            $total = $total + $val->satisfaction_score_2020;
            $count = $count + 1;
    
            $finalValue20 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue20);

        // 2021
        $total = 0;
        $count = 0;
        foreach($emp_sat_val as $val){
            $total = $total + $val->satisfaction_score_2021;
            $count = $count + 1;
    
            $finalValue21 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue21);

        // 2022
        $total = 0;
        $count = 0;
        foreach($emp_sat_val as $val){
            $total = $total + $val->satisfaction_score_2022;
            $count = $count + 1;
    
            $finalValue22 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue22);

        return $kpidata;
    }

    // =======================================================
    // KPI 2 FUNCTIONS
    // =======================================================
    private function kpiTwoAData() {
        $appointment_vals = Appointment::all();
        $average = $this->avgTimeWithPatients();

        $kpidata = array();
        $kpiColors = array();
        $total = 0;
        $count = 0;

        foreach($appointment_vals as $val){
            $count++;
            $total = $total + $val->appointment_time;
            if($count % 25 == 0){
                $avg = round($total / 25, 1);
                $percentChange = (($avg-$average) / $average) * 100;
                array_push($kpidata, $percentChange);
                if($percentChange > 0){
                    array_push($kpiColors, 'rgb(0,255,0)');
                } else {
                    array_push($kpiColors, 'rgb(255,0,0)');
                }
                $total = 0;
            }
        }

        return [$kpidata, $kpiColors];
    }

    // private function kpiTwoBData() {}

    // =======================================================
    // KPI 3 FUNCTIONS
    // =======================================================
    private function kpiThreeAData() {
        $appointment_vals = Appointment::all();
        $average = $this->avgTimeWithPatients();

        $kpidata = array();
        $kpiColors = array();
        $total = 0;
        $count = 0;

        foreach($appointment_vals as $val){
            $count++;
            $total = $total + $val->appointment_time;
            if($count % 25 == 0){
                $avg = round($total / 25, 1);
                $percentChange = (($avg-$average) / $average) * 100;
                array_push($kpidata, $percentChange);
                if($percentChange > 0){
                    array_push($kpiColors, 'rgb(0,255,0)');
                } else {
                    array_push($kpiColors, 'rgb(255,0,0)');
                }
                $total = 0;
            }
        }

        return [$kpidata, $kpiColors];
    }

    private function kpiThreeBData() {
        $kpidata = array();
        // 2018
        $total = 0;
        $count = 0;
        $appointment_vals = Appointment::where('year', '2018')->get();
        foreach($appointment_vals as $val){
            $total = $total + $val->patient_satisfaction;
            $count = $count + 1;
    
            $finalValue18 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue18);

        // 2019
        $total = 0;
        $count = 0;
        $appointment_vals = Appointment::where('year', '2019')->get();
        foreach($appointment_vals as $val){
            $total = $total + $val->patient_satisfaction;
            $count = $count + 1;
    
            $finalValue19 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue19);

        // 2020
        $total = 0;
        $count = 0;
        $appointment_vals = Appointment::where('year', '2020')->get();
        foreach($appointment_vals as $val){
            $total = $total + $val->patient_satisfaction;
            $count = $count + 1;
    
            $finalValue20 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue20);

        // 2021
        $total = 0;
        $count = 0;
        $appointment_vals = Appointment::where('year', '2021')->get();
        foreach($appointment_vals as $val){
            $total = $total + $val->patient_satisfaction;
            $count = $count + 1;
    
            $finalValue21 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue21);

        // 2022
        $total = 0;
        $count = 0;
        $appointment_vals = Appointment::where('year', '2022')->get();
        foreach($appointment_vals as $val){
            $total = $total + $val->patient_satisfaction;
            $count = $count + 1;
    
            $finalValue22 = round($total / $count, 1);
        }
        array_push($kpidata, $finalValue22);

        return $kpidata;
    }

    // =======================================================
    // KPI 4 FUNCTIONS
    // =======================================================
    private function kpiFourAData() {
        $shift_vals = Shift::all();

        $kpidata = array();

        $total = 0;
        $count = 0;
        foreach($shift_vals as $val){
            $count++;
            $total = $total + $val->total_personnel;
            if($count % 25 == 0){
                $avg = round($total / 25, 1);
                array_push($kpidata, $avg);
                $total = 0;
            }
        }

        return [$kpidata, $kpiColors];
    }

    // private function kpiFourBData() {}

}
