<?php

namespace App\Http\Controllers\WebController;

use App\DataTables\SubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscriberDataTable $dataTable)
    {
        return $dataTable->render('admin.subscribers.index' , ['title' => trans('admin/subscribers/index.title'),]);
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
        $client = Subscriber::findOrFail($id);
        $client->delete();

       session()->flash('success',trans('admin/subscribers/index.text_deleted_success'));
        
        return back();
    }


    public function multiDelete()
    {
        if(is_array(request('item')))
        {
        foreach (request('item') as $id)
            {
               $client = Subscriber::findOrFail($id);
               $client->delete();
                
            }
        }else
        {
            $client = Subscriber::findOrFail(request('item'));
            $client->delete();
        }
        session()->flash('success',trans('admin/subscribers/index.text_deleted_success'));
        return  back();
    }
}