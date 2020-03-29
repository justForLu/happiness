<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Product';
    }


}
