<?php

namespace Coclus\Http\Controllers;

use Illuminate\Http\Request;

use Coclus\Http\Requests;
use Alert;
use Auth;
use Hash;
use Redirect;
use Image;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     *
     *
     *
     *
    */
    public function index() {
        return view('logged.settings.settings');
    }



    public function postPerfil(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'comuna' => 'required',
            'address' => 'required'
        ]);

        $user = Auth::user();
        $userName = $user->name;
        $userLastname = $user->lastname;
        $userComuna = $user->comuna;
        $userAddress = $user->address;

        if ($userName == $request->input('name') ||
            $userLastname == $request->input('lastname') ||
            $userComuna == $request->input('comuna') ||
            $userAddress == $request->input('address')) {
            alert()->error('Los campos no deben ser iguales a los anteriores.', 'Error')->autoclose(3000);
            return redirect()->back();
        }

        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->comuna = $request->input('comuna');
        $user->address = $request->input('address');
        $user->save();

        alert()->success('Los cambios han sido guardados satisfactoriamente.', 'Éxito')->autoclose(3000);
        return redirect()->back();
    }

    public function postPassword(Request $request) {
        $this->validate($request, [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|confirmed|min:6',
            'newPassword_confirmation' => 'required'
        ]);

        $user = Auth::user();
        $userOldPassword = $user->password;
        if (!Hash::check($request->input('oldPassword'), $userOldPassword)) {
            alert()
                ->error('La contraseña que ingresaste, no es tu actual contraseña. Intenta nuevamente.', 'Error')
                ->persistent('Cerrar');

            return redirect()->back();
        }


        if (Hash::check($request->input('newPassword'), $userOldPassword)) {
            alert()
                ->error('La nueva contraseña debe ser distinta a la contraseña antigua.', 'Error')
                ->persistent('Cerrar');

            return redirect()->back();
        }

        $user->password = Hash::make($request->input('newPassword'));
        $user->save();

        alert()->success('Los cambios han sido guardados satisfactoriamente.', 'Éxito')->autoclose(3000);
        return redirect()->back();

    }

    public function postAvatar(Request $request) {
        $this->validate($request, [
            'avatar' => 'required|image',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(345, 345)->save(public_path('/uploads/avatars/'. $filename));
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            alert()->success('La imágen ha sido cambiada satisfactoriamente.', 'Éxito')->autoclose(3000);
            return redirect()->back();
        }
        alert()->error('Al parecer hubo un error, intenta nuevamente', 'Error')->autoclose(3000);
        return redirect()->back();
    }

    public function processImage($request, $user){

    }
}
