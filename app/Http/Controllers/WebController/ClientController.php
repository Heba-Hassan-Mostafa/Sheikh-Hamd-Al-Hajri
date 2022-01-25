<?php

namespace App\Http\Controllers\WebController;

use App\Models\Client;
use Illuminate\Http\Request;
use App\DataTables\ClientDataTable;
use App\Http\Controllers\Controller;

use function Ramsey\Uuid\v1;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientDataTable $dataTable)
    {
        return $dataTable->render('admin.clients.index' , ['title' => trans('admin/clients/index.title'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

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
        $client = Client::findOrFail($id);
        $client->delete();

       session()->flash('success',trans('admin/clients/index.text_deleted_success'));
        
        return back();
    }

    
    public function multiDelete()
    {
        if(is_array(request('item')))
        {
        foreach (request('item') as $id)
            {
               $client = Client::findOrFail($id);
               $client->delete();
                
            }
        }else
        {
            $client = Client::findOrFail(request('item'));
            $client->delete();
        }
        session()->flash('success',trans('admin/clients/index.text_deleted_success'));
        return redirect(adminUrl('client'));
    }
    
   
    public function change(Request $request)
    {
        
        $client = Client::findOrFail($request->id);
        $client->status = $request->status;

        $client->save();
        

        return response()->json(['success'=>'Status change successfully.']);

        
    }
    
    
}