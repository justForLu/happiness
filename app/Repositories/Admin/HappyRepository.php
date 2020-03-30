<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class HappyRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Happy';
    }


}
