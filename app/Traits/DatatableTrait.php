<?php

namespace App\Traits;

use Yajra\Datatables\Datatables;

trait DatatableTrait
{
    use MenuPermissionTrait;

    /**
    * Create default Yajra Datatable
    * @param $model model object
    * @param $request array
    * @param $route route definition for action button routing
    * @return Datatable of datatable
    */
    public function makeDatatable($request, $route=null, $key=null)
    {
        $collection = $this->model
                           ->select( 
                                array_merge([
                                    \DB::raw( $this->getRowNum($request) )], 
                                    $this->model->datatableColumns()
                                ) 
                            );

        $datatable  = Datatables::of($collection);

        $this->conditions($datatable);
        $this->buttons($datatable, $route, $key);
        $this->timestamps($datatable);
        $this->makeColumns($datatable);
        $this->rawColumns($datatable);

        return $datatable->make(true);
    }

    /**
    * Get row number Yajra Datatable
    * @author moko
    * @param $primary_key string
    * @param $request array
    * @return string sql
    */
    public function getRowNum($request, $table=null, $orderBy=null){
        $table   = $table ?? $this->model->getTable();
        $orderBy = $orderBy ?? 'created_at';
        
        // get column index frontend
        $order_column = $request->get('order')[0]['column'];

        // nomor urut
        $sql_no_urut = 'row_number() OVER (ORDER BY "' .$table. '"."'. $orderBy .'" DESC) AS rownum'; // row_number() = postgresql function
        if($order_column != 0){

            // ----------------------------
            // Yajra Datatable Index
            $field_name = $request->get('columns')[$order_column]['data']; // field_name

            if(isset($request->get('columns')[$order_column]['name'])){
                $field_name =  $request->get('columns')[$order_column]['name']; // table.field_name
                $tableName = explode('.', $field_name)[0];
                $fieldName = explode('.', $field_name)[1];
            }

            $ordering   = $request->get('order')[0]['dir']; // asc|desc
            // ----------------------------
            
            $sql_no_urut= 'row_number() OVER (ORDER BY "'. $tableName .'"."'. $fieldName .'" '. $ordering .') AS rownum';
        }

        return $sql_no_urut;
    }

    private function conditions($datatable) {
        if(method_exists($this->model, 'datatableCond')) {
            $this->model->datatableCond($datatable);  
        } 

        return $datatable;
    }

    private function makeColumns($datatable) {
        if(method_exists($this->model, 'makeColumns')) {
            $this->model->makeColumns($datatable);  
        } 

        return $datatable;
    }

    private function timestamps($datatable) {
        if(method_exists($this->model, 'timestamps') && $this->model->timestamps() === FALSE) {
            return $datatable;
        }

        return $datatable->addcolumn('created_at', function($datatable){
                                return \Helper::tglIndo($datatable->created_at); 
                            })
                            ->addcolumn('updated_at', function($datatable){
                                return \Helper::tglIndo($datatable->updated_at); 
                            });
    }

    private function rawColumns($datatable) {
        $rawColumns = method_exists($this->model, 'makeColumns')
                        ? $this->model->rawColumns()
                        : [];

        return $datatable->rawColumns(array_merge(['action'], $rawColumns)); // to html
    }

    private function buttons($datatable, $route, $key) {
        $datatableButtons = method_exists($this->model, 'datatableButtons')
                                ? $this->model->datatableButtons() 
                                : ['show', 'edit', 'destroy'];
        $model             = $this->model;
        $route             = $route ?? $this->model->getTable();
        $key               = $key ?? $this->model->getKeyName();

        return $datatable->addColumn('action', function($model) use($route, $key, $datatableButtons){
            $btn_action = '';

            return view('partials.buttons.datatable',[
                'show'    => in_array("show", $datatableButtons ) ? route($route.'.show', $model->$key) : null,
                'edit'    => in_array("edit", $datatableButtons ) ? route($route.'.edit', $model->$key) : null,
                'destroy' => in_array("destroy", $datatableButtons ) ? route($route.'.destroy', $model->$key) : null
            ]);
        });
    }

    
}