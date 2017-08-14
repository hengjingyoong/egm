<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\Counselor;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CounselorAccountController extends Controller
{
    /**
     * CounselorAccountController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('create', 'store');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('counselor.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|min:2|max:32',
            'last_name' => 'required|string|min:2|max:32',
            'gender' => 'required|max:1',
            'type' => 'required|string',
            'school_name' => 'string|min:10|max:60',
            'skype' => 'required|string|min:2|max:60',
            'profile' => 'required|image',
            'proof' => 'required|file',
        ));

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'counselor';
        $user->save();

        $counselor = new Counselor();
        $counselor->first_name = $request->first_name;
        $counselor->last_name = $request->last_name;
        $counselor->gender = $request->gender;
        $counselor->type = $request->type;
        $counselor->school_name = $request->school_name;
        $counselor->skype = $request->skype;
        $counselor->status = 'inactive';
        $counselor->user_id = $user->id;

        $profile = $request->file('profile');
        $filename1 = time() . '.' . $profile->getClientOriginalExtension();
        $location1 = public_path('profiles/' . $filename1);
        Image::make($profile)->resize(170,190)->save($location1);
        $counselor->profile = $filename1;

        $proof = $request->file('proof');
        $filename2 = time() . '.' . $proof->getClientOriginalExtension();
        Storage::disk('proofs')->put($filename2, File::get($proof));
        $counselor->proof = $filename2;

        $counselor->save();

        $notification = array(
            'title' => 'Account Created',
            'message' => 'You have successfully created your counselor account!',
            'alert-type' => 'success'
        );

        Auth::guard()->login($user);
        return redirect()->route('counselor.home')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     * Redirect users back to their page if they are not counselor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = $this->checkUser('counselor');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        $user = User::find($id);
        return view('counselor.account.edit')->withUser($user);
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
        $counselor = $user->counselor;

        $this->validate($request,array(
            'email' => "required|string|email|max:255|unique:users,email,$id",
            'password' => 'nullable|string|min:6|confirmed',
            'first_name' => 'required|string|min:2|max:32',
            'last_name' => 'required|string|min:2|max:32',
            'gender' => 'required|max:1',
            'type' => 'required|string',
            'school_name' => 'string|min:10|max:60',
            'skype' => 'required|string|min:2|max:60',
            'profile' => 'image',
            'proof' => 'file',
        ));

        $user->email = $request->email;
        if($request->password <> '') {$user->password = bcrypt($request->password);}
        $user->save();

        $counselor->first_name = $request->first_name;
        $counselor->last_name = $request->last_name;
        $counselor->gender = $request->gender;
        $counselor->skype = $request->skype;

        if($counselor->type <> $request->type)
        {
            $counselor->type = $request->type;
            $counselor->school_name = $request->school_name;
        }

        if($request->hasFile('profile'))
        {
            $profile = $request->file('profile');
            $filename = time() . '.' . $profile->getClientOriginalExtension();
            $location = public_path('profiles/' . $filename);
            Image::make($profile)->resize(170,190)->save($location);

            $oldFileName = $counselor->profile;
            $counselor->profile = $filename;

            Storage::disk('profiles')->delete($oldFileName);
        }

        if($request->hasFile('proof'))
        {
            $proof = $request->file('proof');
            $filename = time() . '.' . $proof->getClientOriginalExtension();
            Storage::disk('proofs')->put($filename, File::get($proof));

            $oldfilename = $counselor->proof;
            $counselor->proof = $filename;

            Storage::disk('proofs')->delete($oldfilename);
        }

        if($request->hasFile('profile') && $request->hasFile('proof') && $counselor->status == 'rejected')
        {
            $counselor->status = 'inactive';
        }

        $counselor->save();

        $notification = array(
            'title' => 'Account Updated',
            'message' => 'You have successfully updated your account!',
            'alert-type' => 'success'
        );

        return redirect()->route('counselor.home')->with($notification);
    }

}
