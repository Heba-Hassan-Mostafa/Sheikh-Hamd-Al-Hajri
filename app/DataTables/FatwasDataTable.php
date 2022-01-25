<?php

namespace App\DataTables;

// use App\DataTables\UserDataTable;

use App\Models\Fatwas;
use App\Models\Question;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder;

class FatwasDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', 'admin.fatwas.btn.checkbox')
            ->addColumn('status', 'admin.fatwas.btn.status')
            ->addColumn('delete', 'admin.fatwas.btn.delete')
            ->addColumn('reply', function(Fatwas $fat){

                $ans = $fat->question()->where('fatwas_id' , '=' , $fat->id )->first();
                return $ans  ?"<button class= 'done'>".'<i class="fas fa-check-circle"></i>'.trans('admin/template/common.text_done')."</button>" : 
                "<a href= ".'fatwas/'.$fat->id.'/edit'."  class='btn btn-info heba'>"
                 . trans('admin/template/common.text_reply') .'</a> '  ;
   
            })
            ->addColumn('created_at',  function (Fatwas $fatwa) {

                return $fatwa->created_at->format('M-d-Y');
        
                    })
            ->addColumn('message',  function (Fatwas $fatwa) {

                return Str::limit( $fatwa->message, 75 ,'.....')  ;
        
                    })
			->rawColumns([
                'checkbox',
                'status',
                'delete',
                'reply'
               
			]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\UserDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Fatwas::query();
            
        

    }

   

    

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->setTableId('roledatatable-table')
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters(
                    [
                        // 'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 'All Record']],
                        'buttons'      => 
                     [
                       
                    //     ['extend' =>'print' , 'text' => ' <i class="fa fa-print"></i> ' . trans('admin/template/common.text_print')],
                    //     ['extend' =>'excel' , 'text' => '<i class="fa fa-file"></i> '.trans('admin/template/common.text_ex_excel')],
                    //     ['extend' =>'csv' , 'text' => '<i class="fa fa-file"></i> '.trans('admin/template/common.text_ex_csv')],
                    //    // ['extend' =>'pdf' , 'text' => '<i class="fa fa-file"></i> '.trans('admin/template/common.text_ex_pdf')],
                    //     ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i>'.trans('admin/template/common.text_reload')],
                        [ 'text'  => '<i class="fa fa-trash"></i> '.trans('admin/template/common.text_delete_all'), 'className'=>'delBtn'],
                    ],
                   


                    'initComplete' => "function () {
                        this.api().columns([]).every(function () {
                            var column = this;
                            var input = document.createElement(\"input\");
                            $(input).appendTo($(column.footer()).empty())
                            .on('keyup', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                        });
                    }",
                    'language'         => datatable_lang(),
    
                    ]);
                    
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [ [
				'name'  => 'checkbox',
				'data'  => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="check_all()" />',
                'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			],[
				'name'  => 'id',
				'data'  => 'id',
				'title' => 'ID',
            ], 
            [
				'name'  => 'name',
				'data'  => 'name',
				'title' => trans('admin/template/common.text_name'),
            ], 
            [
				'name'  => 'email',
				'data'  => 'email',
				'title' => trans('admin/template/common.text_email'),
            ],
            [
				'name'  => 'message',
				'data'  => 'message',
				'title' => trans('admin/template/common.text_message'),
            ],  
            [
                'name'  => 'created_at',
                'data'  => 'created_at',
                'title' => trans('admin/template/common.text_created_at'),
             ],
             [
				'name'       => 'status',
				'data'       => 'status',
				'title'      => trans('admin/template/common.text_status'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
                'searchable' => false,
            ],
            [
				'name'       => 'reply',
				'data'       => 'reply',
				'title'      => trans('admin/template/common.text_reply'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
            ],
            
             [
				'name'       => 'delete',
				'data'       => 'delete',
				'title'      => trans('admin/template/common.text_delete'),
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
                'searchable' => false,
            ],
            
             

		];
            
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fatwas_' . date('YmdHis');
    }

    
}