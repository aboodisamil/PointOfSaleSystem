<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients=Client::when($request->search , function ($q) use ($request){
            return $q->where('name','like','%'.$request->search.'%')->orWhere('phone','like','%'.$request->search.'%');
        })->latest()->paginate(4);

        return view('dashboard.client.index' , compact('clients'));
    }

    public function create()
    {
        return view('dashboard.client.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required' ,
            'phone' =>'required|array|min:1' ,
            'phone.0' =>'required' ,
            'address'=>'required'
        ]);

        Client::create($request->all());
        session()->flash('AddTrue' , 'THE CLIENT ADDED SUCESSFULLY');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }


    public function edit(Client $client)
    {
        return view('dashboard.client.edit' , compact('client'));
    }

    public function update(Request $request, Client $client)
    {

        $request->validate([
            'name' =>'required' ,
            'phone' =>'required|array|min:1' ,
            'phone.0' =>'required' ,
            'address'=>'required'
        ]);

        $client->update($request->all());
        session()->flash('AddTrue' , 'THE CLIENT UPDATED SUCESSFULLY');
        return redirect()->route('dashboard.client.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('AddTrue' , 'THE CLIENT DELETED SUCESSFULLY');
        return redirect()->back();

    }
}
