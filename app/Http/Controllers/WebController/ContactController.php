<?php

namespace App\Http\Controllers\WebController;

use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('admin.contacts.index' , ['title' => trans('admin/contacts/index.title'),]);
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
        $contact = Contact::findOrFail($id);
        $contact->delete();

       session()->flash('success',trans('admin/contacts/index.text_deleted_success'));
        
        return back();
    }

    public function multiDelete()
    {
        if(is_array(request('item')))
        { 
            foreach (request('item') as $id)
            {
               $client = Contact::findOrFail($id);
               $client->delete();
                
            }
        }else
        {
            $client = Contact::findOrFail(request('item'));
            $client->delete();
        }
        session()->flash('success',trans('admin/contacts/index.text_deleted_success'));
        return redirect(adminUrl('contact'));
    }

    public function change(Request $request)
    {
        
        $contact = Contact::findOrFail($request->id);
        $contact->status = $request->status;

        $contact->save();
        

        return response()->json(['success'=>'Status change successfully.']);

        
    }

}