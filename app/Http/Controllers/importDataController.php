<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company;
use App\Patient;
use App\DummyCompany;
use App\DummyPatient;

class importDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companies()
    {
        $dummyCompanies = DummyCompany::all();

        $diccionario = [];

        foreach ($dummyCompanies as $dummyCompany) {
          $dataCompany = [
            'name'=>$dummyCompany->name,
            'rut'=>$dummyCompany->rut,
            'phone'=>$dummyCompany->phone,
            'email'=>$dummyCompany->email,
            'benefit'=>0,
            'amount'=>0,
            'month'=>1
          ];

          $company = new Company($dataCompany);

          $company->save();

          $diccionario[$dummyCompany->id] = $company->id;
        }

        $dummyPatients = dummyPatient::all();

        foreach ($dummyPatients as $dummyPatient) {
          if(!isset($diccionario[$dummyPatient->company_id])){
            $diccionario[$dummyPatient->company_id]=1;
          }
          $dataPatient = [
            'firstname' => $dummyPatient->first_name,
            'lastname' => $dummyPatient->last_name,
            'address' => $dummyPatient->address,
            'rut' => $dummyPatient->rut,
            'phone' => $dummyPatient->phone,
            'email' => $dummyPatient->email,
            'type' => "Titular",
            'company_id' => $diccionario[$dummyPatient->company_id]
          ];

          $patient = new Patient($dataPatient);

          $patient->save();
        }

        echo ":S";
    }

}
