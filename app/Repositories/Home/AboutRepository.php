<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class AboutRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Feedback';
    }

}
