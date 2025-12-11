<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        return view('settings.user.index');
    }

    public function create()
    {
        return view('settings.user.create');
    }

     public function fetch(Request $request)
    {
        $draw   = $request->get('draw');
        $start  = $request->get('start');  
        $length = $request->get('length'); 
        $searchValue = $request->input('search.value');

        $query = User::query();
        if ($searchValue) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'like', "%$searchValue%")
                  ->orWhere('email', 'like', "%$searchValue%");
            });
        }
        $recordsTotal = User::count();
        $recordsFiltered = $query->count();
        $users = $query
            ->offset($start)
            ->limit($length)
            ->orderBy('id', 'asc')
            ->get();
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'created_at' => $user->created_at->format('Y-m-d H:i'),
                'actions'    => '
                    <button class="btn btn-primary btn-sm">Düzenle</button>
                ',
            ];
        }

        return response()->json([
            'draw'            => intval($draw),
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }
}
