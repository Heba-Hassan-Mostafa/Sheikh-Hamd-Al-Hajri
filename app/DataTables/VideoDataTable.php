<?php

namespace App\DataTables;

// use App\DataTables\UserDataTable;

use App\Models\Video;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder;


class VideoDataTable extends DataTable
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
            ->addColumn('checkbox', 'admin.videos.btn.checkbox')
            //->addColumn('delete', 'admin.videos.btn.delete')
           
			->rawColumns([
                'checkbox',
               //'delete',
               
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
        return Video::whereHasMorph(
            'videoable' ,
            ['App\Models\Lesson', 'App\Models\Lecture' , 'App\Models\Speech'],
           function(Builder $query){
               $query->where('youtubeLink', 'like' ,'https%')
               ->orWhere('youtubeLink', '!=' ,'');
               
           });

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
                       // [ 'text'  => '<i class="fa fa-trash"></i> '.trans('admin/template/common.text_delete_all'), 'className'=>'delBtn'],
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
        return [ 
            // [
			// 	'name'  => 'checkbox',
			// 	'data'  => 'checkbox',
            //     'title' => '<input type="checkbox" class="check_all" onclick="check_all()" />',
            //     'exportable' => false,
			// 	'printable'  => false,
			// 	'orderable'  => false,
			// 	'searchable' => false,
            // ],
            [
				'name'  => 'id',
				'data'  => 'id',
				'title' => 'ID',
            ], 
            [
				'name'  => 'name',
				'data'  => 'name',
				'title' => trans('admin/template/common.text_name'),
            ],
            // [
			// 	'name'  => 'videoable_type',
			// 	'data'  => 'videoable_type',
			// 	'title' => trans('admin/template/common.text_type'),
            // ],  
            
            //  [
			// 	'name'       => 'delete',
			// 	'data'       => 'delete',
			// 	'title'      => trans('admin/template/common.text_delete'),
			// 	'exportable' => false,
			// 	'printable'  => false,
			// 	'orderable'  => false,
            //     'searchable' => false,
            // ],
            
             

		];
            
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Video_' . date('YmdHis');
    }

    
}