<?php 
namespace App\Http\Repositories;


use DB;
class BaseRepository {

    public $model;

    /**
     * Query model
     *
     * @return void
     */
    public function query() {
        $model = $this->model->query();
        return $model;
    }
    
    /**
     * Save model
     *
     * @param array $record
     * @return void
     */
    public function save(array $record) {
        $this->model->fill($record);
        \DB::beginTransaction();
        try {
            $this->model->save();
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }

        return $this->model;
    }
    
    /**
     * Update model
     * 
     * @param int $id
     * @param array $record
     * @return void
     */
    public function update(int $id, array $record) {

        DB::beginTransaction();
        try {
            $model = $this->model->find($id);
            $model->fill($record);
            $model->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        return $model;
    }

    /**
     * Delete model
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id) {

        DB::beginTransaction();

        try {
            $model = $this->model->find($id);
            $isDeleted = $model->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return $isDeleted;
    }



    /**
     * Find model
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id) {
        $model = $this->model->find($id);
        return $model;
    }

}