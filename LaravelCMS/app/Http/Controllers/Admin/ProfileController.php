<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $loggedId = intval( auth::id() );

        $user = User::find($loggedId);

        if($user) {
            return view('admin.profile.index', [ 
                'user' => $user
            ]);
        }

        return redirect()->route('admin');
        
    }

    public function save(Request $request) {
        $loggedId = intval( auth::id() );
        $user = User::find($loggedId);
        
        // Validações
        if($user) {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email']
            ], [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100']
            ]);

            // Passo 1: Alteração do Nome
            $user->name = $data['name'];
            
            // Passo 2: Alteração do e-mail
           
            // Passo 2.1: Verificamos se o email foi alterado
            if($user->email != $data['email'])  {
                // Passo 2.2: Verificamos se o novo email já existe
                $hasEmail = User::where('email', $data['email'])->get();
               
                // Passo 2.3: Se não existir, nós alteramos
                if(count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }
            
            // Passo 3: Alteração da Senha

            // 3.1: Verifica se o usuario digitou a senha
            if(!empty($data['password'])) {
                // Verificação extra de tamanho da senha
                if(strlen($data['password']) >= 4)  {
                   
                    // 3.2: Verifica se a confirmação está OK
                    if($data['password'] === $data['password_confirmation'])  {
                        
                        // 3.3: Alteração da Senha
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }
            
            if(count( $validator->errors() ) > 0){
                return redirect()->route('profile', [
                    'user' => $loggedId
                ])->withErrors($validator);
            }
            
            $user->save();

            return redirect()->route('profile')
                ->with('warning', 'Informações alteradas com sucesso!');
        }

        return redirect()->route('profile');

    }
}
