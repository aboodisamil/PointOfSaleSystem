<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index(Request $request)
    {

        $users=User::whereRoleIs('admin')->where(function ($q) use ($request){
           return $q->when($request->search , function ($query) use ($request) {
               return $query->where('first_name' , 'like' , '%' . $request->search.'%')
                   ->orWhere('last_name' , 'like' ,'%'.$request->search.'%');
           }) ;
        })->latest()->paginate(1);

//      $users=User::whereRoleIs('admin')->when($request->search , function ($query) use ($request)
//        {
//            return $query->where('first_name' , 'like' , '%' . $request->search.'%')
//                ->orWhere('last_name' , 'like' ,'%'.$request->search.'%');
//
//
//        })//->get();
//        ->latest()->paginate(1);


//        $users=DB::table('users')->get()->all();
//        $users=User::whereRoleIs('admin');
        return view('dashboard.users.index' , compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {
        //
        $request->validate([
        'first_name'=>'required|unique:users',
        'last_name'=>'required|unique:users',
        'email'=>'required|unique:users',
        'password'=>'required|confirmed',
         'image'=>'image'  ,
          'permissions'=>'required | min:1'

        ]);

        $request_data=$request->except(['password' , 'permissions' , 'password_confirmation' , 'image']);
        $request_data['password']=bcrypt($request->password);
        $image=$request->image;
        $image_new=time().$image->getClientOriginalName();
        $image->move('uploads/users/' ,$image_new );
        $request_data['image']='uploads/users/'.$image_new;
        $users=User::create($request_data);
        $users->attachRole('admin');
        $users->syncPermissions($request->permissions);
        session()->flash('AddTrue' , 'THE USER ADDED SUCESSFULLY');
        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit' , compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'=>['required ' , Rule::unique('users')->ignore($user->id)] ,
            'last_name'=>['required ' , Rule::unique('users')->ignore($user->id)],
            'email'=>['required ', Rule::unique('users')->ignore($user->id)],
            'password'=>'required|confirmed',
            'image'=>['image ' ,  Rule::unique('users')->ignore($user->id)] ,
            'permissions'=>['required | min:1 ' ,  Rule::unique('users')->ignore($user->id)]

        ]);
        $request_data=$request->except(['permissions' ,'image']);
        $request_data['password']=bcrypt($request->password);
        $image=$request->image;
        $image_new=time().$image->getClientOriginalName();
        $image->move('uploads/users/' ,$image_new );
        $request_data['image']='uploads/users/'.$image_new;

        $user->update($request_data);
        $user->syncPermissions($request->permissions);
        session()->flash('EditTrue' , 'THE USER UPDATED SUCESSFULLY');
        return redirect()->route('dashboard.users.index');

    }

    public function destroy(User $user)
    {
        // لو انت حاطط صورة ديفولت..... وبدك ما تحزف الصورة الافترضيى

        // if you want delete users , the image isnt delte from pupluic/iploard -> if you esnt delete  it

        if ($user->image != '15839505656298.jpg')
        {
         Storage::disk('public_uploads')->delete('/users/'.$user->image);
        }
        $user->delete();
        session()->flash('DeleteTrue' , 'THE USER DELETED SUCESSFULLY');
        return redirect()->route('dashboard.users.index');
    }
}
