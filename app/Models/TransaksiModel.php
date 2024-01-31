<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        	'id_barang','id_pembeli','jumlah','total_harga','created_by','created_date','update_by','update_date','alamat','ongkir','status'
    ];
    protected $returnType = 'App\Entities\Barang';
    protected $useTimesStamps = false; 
}