<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;
use DB;
use File;
use Crypt;
use Input;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Facades\Validator;



class userProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
        
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
        $user = User::find($id);
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->birth = $request->get('birth');
        $user->city = $request->get('city');  
        $user->sex = $request->get('sex');
        if($request->picture != null){ 
            request()->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.request()->picture->getClientOriginalExtension();
            request()->picture->move(public_path('asset/userImage/'), $imageName);
            $user->picture = $imageName;
        }
        $user->save();
        return back();
    }



    //// Change Password of user/////////

    public function changePassword(Request $request){
        request()->validate([
            'old-password' => 'required|min:8',
            'new-password' => 'required|min:8',
            'password-confirmation' => 'required|min:8',
        ]);
            $old_password = $request->get('old-password');
            $value = Auth::user()->password;
            $verify_password = Hash::check($old_password,$value);
            if($verify_password){
                $new_password = $request->get('new-password');
                $confirm_password = $request->get('password-confirmation');
                if($new_password == $confirm_password){
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($new_password);
                    $user->save();
                    return redirect()->back() ->with('success', 'Updated Successfully!'); 
                 }else{
                    return redirect()->back() ->with('alert', 'Updated Not Successfully!'); 
                 }
             }else{
                  return redirect()->back() ->with('alert', 'Updated Not Successfully!!. Your old password incorrect');
             }
    }
            
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $image = User::findOrFail($id);
        if($image->picture != 'user.png'){
            if(\File::exists(public_path("asset/userImage/{$image->picture}"))){
                \File::delete(public_path("asset/userImage/{$image->picture}"));
            }
            $image = User::findOrFail($id)->where('id', Auth::user()->id)->update([
                'picture' => 'user.png',
            ]);
            return back();
        }else {
            return back();
        }
    }

}
