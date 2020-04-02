<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class RememberRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Remember';
    }


}
