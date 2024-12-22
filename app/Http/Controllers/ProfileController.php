<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('employee.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Valider et remplir les autres champs
        $user = $request->user();

        $user->fill($request->validated());


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Gestion de l'image de profil
//        if ($request->hasFile('picture')) {
//            // Supprimer l'ancienne image si elle existe
//            if ($user->picture) {
//                $oldPicturePath = 'public/' . $user->picture;
//                if (Storage::exists($oldPicturePath)) {
//                    Storage::delete($oldPicturePath);
//                }
//            }
//
//            // Récupérer l'extension du fichier
//            $extension = $request->file('picture')->getClientOriginalExtension();
//
//            // Créer un nom de fichier lisible
//            $fileName = strtolower(str_replace(' ', '_', $user->first_name . '_' . $user->last_name)) . '_' . time() . '.' . $extension;
//
//            // Stocker la nouvelle image avec le nom lisible
//            $path = $request->file('picture')->storeAs('profile_pictures', $fileName, 'public');
//
//            // Sauvegarder le chemin dans la base de données
//            $user->picture = $path;
//        }

        // Sauvegarder les modifications de l'utilisateur
        $user->save();
//        dd($user);
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
