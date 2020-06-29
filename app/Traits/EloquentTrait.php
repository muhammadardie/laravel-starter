<?php

namespace App\Traits;

trait EloquentTrait
{
    // protected $model;
    
    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // Get relation of model
    public function with($relation)
    {
        return $this->model->with($relation);
    }

    // Get relation of model by conditions
    public function where($conditions)
    {
        return $this->model->where($conditions);
    }
    
    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get relations of model for the determined record
    public function withShow($relations,$id)
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    // create a new record in the database
    public function store(array $data, $storeImage=false, $recordCreated=false)
    {
        \DB::beginTransaction();
        $transaction = false;

        try {
            // store record without upload file
            if(!$storeImage){
                $storeRecord = $this->model->create($data);
            } else {
                // store record with upload file
                $files = [];

                foreach ($data as $key => $value) {
                    if(is_object($value)){
                        unset($data[$key]);

                        $file['name'] = $key;
                        $file['file'] = $value;

                        array_push($files, $file);
                    }
                }

                $storeRecord = $this->model->create($data);
                if( !empty($files) ) $this->upload($files, $storeRecord);
            }
            

            \DB::commit();
            $transaction = true;
        } catch (\Exception $e) {
            \DB::rollback();

            // error page
            abort(404, $e->getMessage());
        }
        
        return $recordCreated ? $storeRecord : $transaction;
    }

    // update record in the database
    public function update(array $data, $id, $updateImage=false, $recordUpdated=false)
    {
        \DB::beginTransaction();
        $trans = false;

        try {

            $record = $this->show($id);
            
            // store record without upload file
            if(!$updateImage){
                $updateRecord = $record->update($data);
            } else {
                // store record with upload file
                $files = [];

                foreach ($data as $key => $value) {
                    if(is_object($value)){
                        unset($data[$key]);

                        $file['name']     = $key;
                        $file['file']     = $value;
                        $file['old_file'] = $record->$key;

                        array_push($files, $file);
                    }
                }

                $updateRecord = $record->update($data);
                if( !empty($files) ) $this->upload($files, $record);
            }

            \DB::commit();
            $trans = true;
        } catch (\Exception $e) {
            \DB::rollback();
            
            // error page
            abort(404, $e->getMessage());
        }
        
        return $recordUpdated ? $record : $trans;
    }

    // remove record from the database
    public function delete($id)
    {        
        return $this->model->destroy($id);
    }

    public function makeDropdown($indexField)
    {
        return $this->model->orderBy($indexField)->pluck($indexField, $this->model->getKeyName());
    }
}