<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Responsável por carregar os dados da página perfil
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        $loggedId = Auth::id();

        $user = User::find($loggedId);

        if ($user) {
            return view('admin.profile.index', [
                'user' => $user
            ]);
        }

        return redirect()->route('home');
    }

    /**
     * Salva as informações do perfil
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        $loggedId = Auth::id();
        $user = User::find($loggedId);

        if ($user) {
            $data = $request->only([
                'name',
                'image',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'image' => $data['image'],
                'email' => $data['email']
            ],  [
                'name'  => ['required', 'string', 'max:100'],
                'image' => ['nullable', 'image', 'max:3072'],
                'email' => ['required', 'string', 'email', 'max:100']
            ]);

            $user->name = $data['name'];

            if ($data['image']) {
                if ($user->image && Storage::exists($user->image)) {
                    Storage::delete($user->image);
                }
                $path = $data['image']->store('users');
                $user->image = $path;
            }

            if ($user->email != $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();

                if (count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            if (!empty($data['password'])) {
                if (strlen($data['password']) >= 8) {
                    if ($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 8
                    ]));
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('profile', [
                    'user' => $loggedId
                ])->withErrors($validator);
            }

            $user->save();

            return redirect()->route('profile')->with('warning', 'Informações alteradas com sucesso!');
        }

        return redirect()->route('profile');
    }
}
