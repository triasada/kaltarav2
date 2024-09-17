<?php

namespace App\Http\Controllers\Backend;

use App\District;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = Auth::user();
        return view('user.edit_profile', $data);
    }

    public function updateProfile(Request $request)
    {
        try
        {
            $user = Auth::user();
            $user->name = $request->name;
            $user->birth_date = ($request->birth_date)? Carbon::createFromFormat('d-m-Y', $request->birth_date):null;
            $user->gender = $request->gender;
            $user->address = $request->address;
            if($request->phone_number)
            {
                $user->phone_number = $request->phone_number;
            }
            else
            {
                $user->phone_number = null;
            }

            $file = $request->photo;
			if ($file)
			{
				$config['disk'] = 'upload';
				$config['upload_path'] = '/user/'.$user->id.'/photo';
				$config['public_path'] = env('APP_URL') . '/upload/user/'.$user->id.'/photo';

				// create directory if doesn't exist
				if (!Storage::disk($config['disk'])->has($config['upload_path']))
				{
					Storage::disk($config['disk'])->makeDirectory($config['upload_path']);
				}

				// upload file if valid
				if ($file->isValid())
				{
					$filename = uniqid() .'.'. $file->getClientOriginalExtension();

					Storage::disk($config['disk'])->putFileAs($config['upload_path'], $file, $filename);
					$user->photo_profile_path = $config['disk'].$config['upload_path'].'/'.$filename;
				}
			}
            $user->save();

            return redirect()->back()->withSuccess('Success');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }

    public function editPassword()
    {
        $data['title'] = 'Change Password';
        return view('user.edit_password', $data);
    }

    public function updatePassword(Request $request)
    {
        try
        {
            $rule = [
                'new_password' => 'required|confirmed|min:6',
            ];
            $validation = Validator::make($request->toArray(), $rule);
            if($validation->fails())
            {
                return redirect()->back()->withErrors($validation->errors());
            }

            $user = Auth::user();
            if (!Hash::check($request->old_password, $user->password))
            {
                return redirect()->back()->withErrors('Old password wrong');
            }
            
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->withSuccess('Password Updated');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }

    public function index()
    {
        $this->authorize('View User', Auth::user());

        $users = User::where('id','!=', 1)->get();
        $data['title'] = 'List User';
        $data['users'] = $users;
        return view('user.index', $data);
    }

    public function create()
    {
        $this->authorize('Create User', Auth::user());

        $user = Auth::user();
        if($user->hasRole('Super Admin'))
        {
            $roles = Role::get()->pluck('name', 'id');
        }
        else
        {
            $roles = Role::where('id','!=', 1)->get()->pluck('name', 'id');
        }
        $data['districts'] = District::get()->pluck('name','id');
        $data['title'] = 'Add User';
        $data['roles'] = $roles;
        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create User', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                $user = new User();
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = Hash::make($request->password);
                $user->birth_date = Carbon::createFromFormat('d-m-Y', $request->birth_date);
                $user->gender = $request->gender;
                $user->district_id = $request->district;
                $user->sk = $request->sk;
                $user->address = $request->address;
                $user->phone_number = $request->phone_number;
                $user->save();

                $role = Role::findById($request->role_id);
                $user->assignRole($role->name);
            });
            return redirect()->route('user.index')->withSuccess('Create user success');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }

    public function edit($id)
    {
        $this->authorize('Edit User', Auth::user());

        $user = User::findOrFail($id);
        $currentUser = Auth::user();
        if($currentUser->hasRole('Super Admin'))
        {
            $roles = Role::get()->pluck('name', 'id');
        }
        else
        {
            $roles = Role::where('id','!=', 1)->get()->pluck('name', 'id');
        }
        $data['title'] = 'Edit User';
        $data['roles'] = $roles;
        $data['districts'] = District::get()->pluck('name','id');
        $data['user'] = $user;
        return view('user.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->authorize('Edit User', Auth::user());
        try
        {
            $user = User::findOrFail($id);
            $role = Role::findById($request->role_id);
            DB::transaction(function () use ($request, $user, $role)
            {
                $user->email = $request->email;
                $user->name = $request->name;
                // $user->password = Hash::make($request->password);
                $user->birth_date = Carbon::createFromFormat('d-m-Y', $request->birth_date);
                $user->gender = $request->gender;
                $user->district_id = $request->district;
                $user->sk = $request->sk;
                $user->address = $request->address;
                $user->phone_number = $request->phone_number;
                $user->save();

                //$user->assignRole($role->name);
                $user->syncRoles($role);
            });
            return redirect()->route('user.index')->withSuccess('Update user success');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }

    public function destroy($id)
    {
        $this->authorize('Delete User', Auth::user());
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->withSuccess('Delete user success');
    }

    public function approve($id)
    {
        $this->authorize('Edit User', Auth::user());
        $user = User::findOrFail($id);
        $user->is_approved = 1;
        $user->approved_by = Auth::user()->id;
        $user->save();
        return redirect()->route('user.index')->withSuccess('Approve user success');
    }

    public function cancelApprove($id)
    {
        $this->authorize('Edit User', Auth::user());
        $user = User::findOrFail($id);
        $user->is_approved = 0;
        $user->approved_by = 0;
        $user->save();
        return redirect()->route('user.index')->withSuccess('Cancel Approve user success');
    }

    public function editPasswordAdmin($id)
    {
        $this->authorize('Edit User', Auth::user());
        $user = User::findOrFail($id);
        $data['user'] = $user;
        $data['title'] = 'Edit Password User';
        return view('user.edit_password_admin', $data);
    }

    public function updatePasswordAdmin($id, Request $request)
    {
        try
        {
            $user = User::findOrFail($id);
            $rule = [
                'new_password' => 'required|confirmed|min:6',
            ];
            $validation = Validator::make($request->toArray(), $rule);
            if($validation->fails())
            {
                return redirect()->back()->withErrors($validation->errors());
            }
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('user.index')->withSuccess('Password updated');
        }
        catch (\Throwable $th)
        {
            $message = $th->getMessage().' || '. $th->getFile().' || '. $th->getLine();
            Log::error($message);
            return redirect()->back()->withErrors($message);
        }
    }
}
