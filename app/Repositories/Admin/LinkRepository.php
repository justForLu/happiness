<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class LinkRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Link';
    }


}
