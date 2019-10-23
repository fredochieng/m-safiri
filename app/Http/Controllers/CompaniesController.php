<?php

namespace App\Http\Controllers;

use App\Models\Companies\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kamaln7\Toastr\Facades\Toastr;
use DB;

// use Kamaln7\Toastr\Facades\Toastr;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['companies'] = Company::getCompanies();
        return view('companies.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company_name = strtoupper($request->input('company_name'));
        $address = strtoupper($request->input('address'));
        $zipcode = $request->input('zipcode');
        $contact_name = $request->input('contact_name');
        $contact_email = $request->input('contact_email');
        $contact_number = $request->input('contact_number');
        $password = $contact_number;

        $company = new Company();
        $company->company_name = $company_name;
        $company->address = $address;
        $company->zipcode = $zipcode;
        $company->contact_number = $contact_number;
        $company->created_by = Auth::id();
        $company->save();

        $saved_company_id = $company->id;

        $user = new User();
        $user->company_id = $saved_company_id;
        $user->name = $contact_name;
        $user->email = $contact_email;
        $user->password =  Hash::make($password);

        $user->save();

        $saved_user_id = $user->id;

        $role_id = 2;
        $company_role = array(
            'role_id' => $role_id,
            'model_id' => $saved_user_id,
            'model_type' => 'App\User'
        );
        $save_user_role_data = DB::table('model_has_roles')->insert($company_role);

        Toastr::success('Company added successfully');
        return back();
    }

    public function manageCompany($company_id)
    {
        $data['companies'] = Company::getCompanies()->where('company_id', $company_id)->first();
        //dd($data['companies']);

        return view('companies.manage')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();

        Toastr::success('Company deleted successfully');
        return back();
    }
}