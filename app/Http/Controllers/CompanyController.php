<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(10);
        return view('companies.index')->with('companies',$companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:125',
            'email'=> 'nullable|email|max:125|unique:companies',
            'website'=> 'nullable|string|max:125',
            'logo' => 'image|nullable|max:1999|dimensions:min_width=100,min_height=100'
        ]);

        // Hadle file upload
        if($request->hasFile('logo')){

            $extension = $request->file('logo')->getClientOriginalExtension();

            $fileNameToStore = time().'.'.$extension;

            $request->file('logo')->storeAs('public',$fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.png';
        }


        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website =$request->input('website');
        $company->logo = $fileNameToStore;

        if($company->save()){


            try{
                Mail::raw('New company has been created!', function($message)
                {
                    $message->subject('Company created');

                    // $message->to(Auth::user()->email);

                    $message->to('aleksandarustic2@gmail.com');
                });

            }
            catch (\Exception $e){
                return redirect()->route('company.index')->with('message','Company has been successfuly created')->with('error','Error with sending email:');
            }


            return redirect()->route('company.index')->with('message','Company has been successfuly created');
        }
        else{
            return redirect()->route('company.create')->with('error','Company has not been successfuly created');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show')->with('company',$company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit')->with('company',$company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $company = Company::findOrFail($id);

        $this->validate($request,[
            'name' => 'required|string|max:125',
            'email'=> 'nullable|email|max:125|unique:companies,email,'.$company->id,
            'website'=> 'nullable|string|max:125',
            'logo' => 'image|nullable|max:1999|dimensions:min_width=100,min_height=100'
        ]);

        // Hadle file upload
        if($request->hasFile('logo')){

            // Delete old image
            if($company->logo != 'noimage.png'){
                Storage::delete('public/'. $company->logo);
            }

            $extension = $request->file('logo')->getClientOriginalExtension();

            $fileNameToStore = time().'.'.$extension;

            $request->file('logo')->storeAs('public',$fileNameToStore);

            $request->merge(array('logo' => $fileNameToStore));
        }

        if( $company->update($request->input())){

            return redirect()->route('company.index')->with('message','Company has been successfuly updated');
        }
        else{
            return redirect()->route('company.edit');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('company.index')->with('message','Company has been successfuly deleted');
    }
}
