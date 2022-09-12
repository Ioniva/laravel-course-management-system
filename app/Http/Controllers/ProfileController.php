<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use function MongoDB\BSON\toJSON;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        // Recoger la configuracion de las notificaciones
        $notification = Notification::where('users_id', Auth::user()->id)->first();
        // Comprobar si esta vacia

        return View::make('profile.index', compact('notification'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return
     */
    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        $notification = Notification::where('users_id', $id)->first();

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->telephone = $request->get('telephone');
        $user->nif = $request->get('nif');
        if (!empty ($request->get('password'))) {
            $user->password = Hash::make($request->get('pass'));
        }

        if ($notification !== NULL) {
            $request->get('work') === 'on' ? $notification->work = '1' : $notification->work = '0';
            $request->get('exam') === 'on' ? $notification->exam = '1' : $notification->exam = '0';
            $request->get('continuous_assessment') === 'on' ? $notification->continuous_assessment = '1'
                : $notification->continuous_assessment = '0';
            $request->get('final_note') === 'on' ? $notification->final_note = '1' : $notification->final_note = '0';
        }


        if ($notification !== NULL) {
            $user->save();
            $notification->save();
        } else {
            //$user->save();
            Notification::create($user);
        }


        return redirect('/calendar');
    }

}
