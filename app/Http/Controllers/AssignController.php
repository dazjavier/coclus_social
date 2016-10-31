<?php
namespace Coclus\Http\Controllers;

use Coclus\Http\Requests;
use Illuminate\Http\Request;
use Coclus\Speciallity;
use Alert;
use Auth;
use DB;

class AssignController extends Controller
{
    public function setDeafView() {
        return $this->isProfileSetted() ? redirect()->to('/my_profile') : view('logged.assign.deaf');
    }

    public function setFamiliarView() {
        return $this->isProfileSetted() ? redirect()->to('/my_profile') : view('logged.assign.familiar');
    }

    public function setProfessionalView() {
        $speciallities = $this->getProfessionalSpeciallities();
        return $this->isProfileSetted() ? redirect()->to('/my_profile') : view('logged.assign.professional')->with('speciallities', $speciallities);
    }

    public function getProfile() {
        $profile_type = Auth::user()->profile_type;

        return redirect('/set_profile/' . $profile_type);
    }


    public function postDeaf(Request $request) {
        $userId = Auth::user()->id;

        if (!$this->setUserInterests($request, $userId) ||
            !$this->setDeafCommunicationTypes($request, $userId)) {
            alert()->error('Debes seleccionar al menos una forma de comunicación y un interés.', 'Error')->autoclose(3000);
            return back();
        }

        Auth::user()->avatar = "persona_sorda.png";
        Auth::user()->save();

        $this->postAssignProfile('Has configurado tu perfil correctamente.');
        return redirect()->to('/my_profile');
    }



    public function postFamiliar (Request $request) {
        $this->validate($request, [
            'relation' => 'required',
            'step' => 'required',
        ]);

        $userId = Auth::user()->id;

        if (!$this->setUserInterests($request, $userId) ||
            !$this->setDeafCommunicationTypes($request, $userId)) {
            alert()->error('Debes seleccionar al menos una forma de comunicación y un interés.', 'Error')->autoclose(3000);
            return back()->withInput();
        }

        $familiar = DB::table('familiar')->insert([
            ['user_id' => $userId, 'relation' => $request->input('relation'), 'step' => $request->input('step')],
        ]);

        Auth::user()->avatar = "familiar.png";
        Auth::user()->save();

        $this->postAssignProfile('Has configurado tu perfil correctamente.');
        return redirect()->to('/my_profile');
    }

    public function postProfessional(Request $request) {
        $this->validate($request, [
            'speciallity' => 'required',
            'category' => 'required',
        ]);

        $userId = Auth::user()->id;

        if (!$this->setUserInterests($request, $userId)) {
            alert()->error('Debes seleccionar al menos un interés.', 'Error')->autoclose(3000);
            return back()->withInput();
        }

        $professional = DB::table('professional')->insert([
            ['user_id' => $userId, 'speciallity_id' => $request->input('speciallity'), 'category' => $request->input('category')],
        ]);

        Auth::user()->avatar = "doctor.png";
        Auth::user()->save();

        $this->postAssignProfile('Has configurado tu perfil correctamente.');
        return redirect()->to('/my_profile');
    }


    public function setUserInterests(Request $request, $userId) {
        $intereses = $request->input("intereses");
        if ($intereses[0] == "") { return;}
        $intereses = explode(', ', $intereses[0]);
        for ($x = 0; $x < count($intereses); $x++) {
            DB::table('interest')->insert(['user_id' => $userId, 'name' => $intereses[$x]]);
        }
        return true;
    }

    public function setDeafCommunicationTypes(Request $request, $userId) {
        $communication = $request->input("comunicacion");
        if ($communication[0] == "") { return; }
        $communicationId = array();

        if (in_array('Implante Coclear', $communication)) { array_push($communicationId, 1); }
        if (in_array('Audífono', $communication)) { array_push($communicationId, 2); }
        if (in_array('Lengua de Señas', $communication)) { array_push($communicationId, 3); }

        for ($i = 0; $i < count($communicationId); $i++) {

            DB::table('deaf')->insert(['user_id' => $userId, 'communication_type_id' => $communicationId[$i]]);
        }

        return true;
    }

    public function getProfessionalSpeciallities() {
        return $speciallities = Speciallity::all();
    }

    public function postAssignProfile($message) {
        $user = Auth::user();
        $user->has_profile_set = 1;
        $user->save();
        return alert()->success($message, '¡Felicidades!')->autoclose(3000);
    }

    public function isProfileSetted() {
        return Auth::user()->has_profile_set != 0;
    }
}
