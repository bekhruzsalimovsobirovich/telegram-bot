<?php

namespace App\Http\Controllers\Peoples;

use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $peoples = People::query()
            ->withTrashed()
            ->paginate(20);

        return view('admin.peoples.index', [
            'peoples' => $peoples
        ]);
    }

    public function appeals()
    {
        $appeals = Appeal::query()
            ->paginate(20);

        return view('admin.appeals.index', [
            'appeals' => $appeals
        ]);
    }
}
