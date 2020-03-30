<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class EventRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Event';
    }


}
