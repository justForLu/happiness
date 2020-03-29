<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class NewsRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\News';
    }


}
