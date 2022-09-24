<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Document;
use App\Models\Notification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    //
    public function login(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;
            if ($user->status == 0) {
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                if ($role == 'manager') {
                    return redirect('/manager/login');
                } else if ($role == 'company') {
                    return redirect('/company/login');
                } else {
                    return redirect('/');
                }
            }

            //$user->givePermissionTo('company');
            if ($role == 'manager') {
                return redirect()->intended(RouteServiceProvider::MANAGER_HOME);
            } else if ($role == 'company') {
                return redirect()->intended(RouteServiceProvider::COMPANY_HOME);
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
        return view('auth.super-login');
    }

    public function manageCompany(){
        return view('admin.company-manage');
    }
    public function tableCompany(Request $request){
        $status = $request->status;
        $contact = $request->contact;
        if (isset($status)){
            $data = User::where('role', 'company')->where('status', $status)->where(function ($query) use ($contact) {
                $query->where('contact', 'like', '%' . $contact . '%')->orWhere('name', 'like', '%' . $contact . '%');
            })->get();
        }
        else{
            $data = User::where('role', 'company')->where(function ($query) use ($contact) {
                $query->where('contact', 'like', '%' . $contact . '%')->orWhere('name', 'like', '%' . $contact . '%');
            })->get();
        }

        return view('admin.company-table', compact('data'));
    }

    public function addCompany(){
        $ex = true;
        $code = 0;
        while($ex){
            $code = rand(100000, 999999);
            $c_user = User::where('user_code', $code)->first();
            if(!isset($c_user)) {
                $ex = false;
            }
        }
        return view('admin.company-add', compact('code'));
    }
    public function editCompany($id){
        $user = User::find($id);
        return view('admin.company-add', compact('user'));
    }

    public function saveCompany(Request $request){
        $id = $request->id;
        if(!isset($id)){
            $company = Company::create(['name' => $request->name]);
            $data = [
                'role' => 'company',
                'user_code' => $request->user_code,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'post_code' => $request->post_code,
                'address' => $request->address,
                'contact' => $request->contact,
                'charge' => $request->charge,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'company_id' => $company->id
            ];
            $user = User::create($data);
            $user->givePermissionTo('company');
        }
        else{
            if(isset($request->password)){
                $data = [
                    'user_code' => $request->user_code,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'charge' => $request->charge,
                    'status' => $request->status,
                    'remarks' => $request->remarks
                ];
            }
            else{
                $data = [
                    'user_code' => $request->user_code,
                    'name' => $request->name,
                    'email' => $request->email,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    'charge' => $request->charge,
                    'status' => $request->status,
                    'remarks' => $request->remarks
                ];
            }
            User::find($id)->update($data);
            $company_id = User::find($id)->company_id;
            Company::find($company_id)->update(['name' => $request->name]);
        }
        return response()->json(['status' => true]);
    }

    public function deleteCompany(Request $request){
        $id = $request->id;
        $user = User::find($id);
        $company_id = $user->company_id;
        User::where('company_id', $company_id)->delete();
        //User::where('id', $id)->delete();
        Document::where('company_id', $company_id)->delete();
        Notification::where('company_id', $company_id)->delete();
        return response()->json(['status' => true]);
    }
}
