<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

class NotebookRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Common\Notebook';
    }


}
