<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table      = 'order_items';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'price', 'created_by', 'updated_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
