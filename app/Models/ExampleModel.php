<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Webpatser\Uuid\Uuid;

class ExampleModel extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table      = 'tablename';
    protected $primaryKey = 'tablename_id';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;


    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->tablename_id = (string) Uuid::generate(4);
        });
    }
    
	/**
    * required by makeDatatable function if you're using DatatableService
    *
    * @return array of column name selected by datatable
    */
	public function datatableColumns()
	{
	    return [
	    		'tablename.tablename_id',
			    'tablename.nama',
			    'tablename.created_at',
			    'tablename.updated_at'
			];
	}

	/**
    * required by makeDatatable function if you're using DatatableService
    *
    * @return array of action button used by datatable
    */
	public function datatableButtons()
	{
	    return ['show', 'edit', 'destroy'];
	}

	/**
    * optional function if you're using DatatableService
    * use it when you need custom query for show your data in datatable
    * @return extended collection of datatable that can be used to addColumn
    */
	public function scopeDatatableCond($query) {
        return $query
            ->join('tagihan', 'tagihan.tagihan_id', '=', 'pembayaran.tagihan_id')
            ->join('permintaan', 'permintaan.permintaan_id', '=', 'tagihan.permintaan_id')
            ->join('cara_bayar', 'cara_bayar.cara_bayar_id', '=', 'permintaan.cara_bayar_id')
            ->join('keranjang', 'keranjang.keranjang_id', '=', 'permintaan.keranjang_id')
            ->join('konsumen', 'konsumen.konsumen_id', '=', 'keranjang.konsumen_id')
            ->where('permintaan.status_id', '=', 2);
    }

    /**
    * optional function if you're using DatatableService
    * use it when you're need to add custom column to datatable
    * @return extended collection of datatable that can be used to addColumn
    */
    public function makeColumns($query) {
    	// example
        $columns = $query
            ->addColumn('nilai_pembayaran', function($collection) {
                return \Helper::number_formats($collection->nilai_pembayaran, 'view', 0);
            })
            ->addColumn('tgl_pembayaran', function($collection) {
                return \Helper::tglIndo($collection->tgl_pembayaran);
            });

        return $columns;
    }

    /**
    * optional function if you're using DatatableService, default is true
    * use it when you're need to add formatted created_at and updated_at column to datatable
    * @return added created_at and updated_at column to datatable collection
    */
    public function timestamps() {
        return true;
    }

}
