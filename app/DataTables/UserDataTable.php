<?php

namespace App\DataTables;

use App\User;
// use App\DataTables\UserDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Spatie\Permission\Models\Role;


class UserDataTable extends DataTable
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
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->addColumn('edit', 'admin.users.btn.edit')
            ->addColumn('delete', 'admin.users.btn.delete')
            ->addColumn('status', 'admin.users.btn.status')
            ->addColumn('roles', function ($user) { 
                return '<span class="role-color">'.implode(" & " , $user->roles->pluck('name')->toArray()).'</span>'   ;
              })
			->rawColumns([
                'checkbox',
				'edit',
                'delete',
                'status',
                'roles'
               
			]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\UserDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $user)
    {
        return User::query()->with('roles');
                  
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
                    ->setTableId('userdatatable-table')
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters(
                    [
                        // 'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 'All Record']],
                        'buttons'      => 
                     [
                        [ 'text'  => '<i class="fa fa-plus"></i> '.trans('admin/template/common.text_create_user'),'className'=>'addBtn',
                         "action"=>"function(){
                             window.location.href='".URL::current()."/create';
                         }"
                            
                        ],
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
			], [
				'name'  => 'name',
				'data'  => 'name',
				'title' => trans('admin/template/common.text_user_name'),
			], [
				'name'  => 'email',
				'data'  => 'email',
				'title' => trans('admin/template/common.text_email'),
            ],
            //  [
			// 	'name'  => 'created_at',
			// 	'data'  => 'created_at',
			// 	'title' => trans('admin/template/common.text_created_at'),
            // ], 
            [
				'name'  => 'roles',
				'data'  => 'roles',
				'title' => trans('admin/template/common.text_role'),
            ],
             [
                'name'  => 'status',
                'data'  => 'status',
                'title' => trans('admin/template/common.text_status'),
            ], 
             [
				'name'       => 'edit',
				'data'       => 'edit',
				'title'      => trans('admin/template/common.text_edit'),
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
        return 'User_' . date('YmdHis');
    }

    
}