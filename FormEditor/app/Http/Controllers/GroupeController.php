<?php

namespace App\Http\Controllers;

use App\Models\Forms;
use App\Models\Groupe;
use App\Models\FormsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreGroupesRequest;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $formsList = Forms::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
        return view('groupes.list', ['formsList' => $formsList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $forms = Forms::where('id', $id)->get();
        $forms = $forms[0];
        $formsList = Forms::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
        return view('groupes.create', ['forms' => $forms, 'formsList' => $formsList, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(/*StoreGroupesRequest*/Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $request->validated();
        $forms = Forms::findOrFail($request->input('form_id'));
        $groupes = FormsUser::create($request->input());
        $groupes->form()->associate($forms);
        $groupes->save();
        $groupes->users()->associate(Auth::id());
        $groupes->save();

        // return redirect()->route('forms.show', ['form' => $forms]);
        return redirect()->route('groupes.index')->with('message', 'Votre groupe a été créé avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormsUser  $groupe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formsList = Forms::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
        return view('groupes.consult', ['groupe' => Forms::findOrFail($id), 'formsList' => $formsList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormsUser  $groupe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        // if (!Gate::allows('groupe-access', $groupe = FormsUser::findOrFail($id))) {
        //     abort('403');
        // }
        $groupeID = DB::table('forms_user')->where('user_id', $id)->select('user_id');
        $forms = Forms::where('id', $id)->get();
        $forms = $forms[0];
        $formsList = Forms::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
        return view('groupes.edit', ['groupe' => Forms::findOrFail($id), 'forms' => $forms, 'formsList' => $formsList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forms $groupe)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            // 'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|max:300',
        ]);
        if (!empty($request['title'])) {
            DB::table('forms')->where('id', $groupe->id)->update(['title' => $request['title']]);
        }
        if (!empty($request['description'])) {
            DB::table('forms')->where('id', $groupe->id)->update(['description' => $request['description']]);
        }
        if (!empty($request['logo'])) {
            DB::table('forms')->where('id', $groupe->id)->update(['logo' => $request['logo']]);
        }

        // return redirect()->route('groupes.show', ['groupe' => $groupe]);
        return redirect()->route('groupes.show', ['groupe' => $groupe])->with('message', 'Votre groupe à été correctement mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $groupe = DB::table('forms_user')->where('user_id', $id)->select('user_id');
        $nameMember = DB::table('users')->where('id', $id)->select('firstname')->get();
        $nameMember = $nameMember[0]->firstname;
        // $groupe = FormsUser::findOrFail($id);
        $groupe->delete();
        return redirect()->route('groupe')->with('message', "$nameMember à été retiré de votre groupe !");;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMember(/*StoreGroupesRequest*/Request $request, Forms $groupe)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $request->validate([
            'membreEmail' => 'required|email',
        ]);
        if (!empty($request['membreEmail'])) {

            $userEmail = DB::table('users')->where('email', $request['membreEmail'])->get() ?? '';
            /* Si l'utilisateur existe : vérif mail */
            if ($userEmail->first() == NULL) {
                return redirect()->route('groupe')->with('message', 'Le mail ne correspond à aucun utilisateur !');
            } else {
                /* Ajout du mebre au groupe */
                DB::insert('insert into forms_user (forms_id, user_id) values (?, ?)', [$groupe->id, $userEmail->first()->id]);
            }
        }
        // return redirect()->route('forms.show', ['form' => $forms]);
        return redirect()->route('groupe')->with('message', 'Membre ajouté avec succès !');
    }
}
