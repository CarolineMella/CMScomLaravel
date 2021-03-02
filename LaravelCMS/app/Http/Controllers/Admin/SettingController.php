<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use\Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        // Pegar as informações do bando de dados e colocar em array.
        $settings = [];

        $dbsettings = Setting::get();

        foreach($dbsettings as $dbsetting) {
            $settings [ $dbsetting['name'] ] = $dbsetting['content'];
        }

       return view('admin.settings.index', [
           'settings' => $settings
       ]);
    }

    public function save(Request $request) {
        $data = $request->only([
            'title', 'subtitle', 'email', 'bgcolor', 'textcolor'
        ]);

        $validator = $this->validator($data);

        if($validator->fails()) {
            // Se der erro redirecionar:
            return redirect()->route('settings')
            ->withErrors($validator);
        }
        // Se der tudo certo-> salvar:
        foreach($data as $item => $value){            // Pegar todos os campos e alterar uma a uma.
            Setting::where('name', $item)->update([
                'content' => $value
            ]);
        } 
        
        return redirect()->route('settings')
            ->with('warning', 'Informações alteradas com sucesso!');
    }

    protected function validator($data) {
        return Validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'emaill' => ['string', 'email'],
            'bgcolor' => ['string', 'regex:/#[A-Za0-9]{6}/i'],
            'textcolor' => ['string', 'regex:/#[A-Z0-9]{6}/i']
        ]);
    }
}
