<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Exports\ConductorExport;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $firebase = $this->conectarFirebase();

        $database = $firebase->getDatabase();
        $ref = $database->getReference('conductores');
        $conductores = $ref->getValue();

        $all_conductores = [];
        if ($conductores != null) {
            foreach ($conductores as $uid=>$user) {
                $con = [
                    'nombre' => $user['nombre'],
                    'telefono' => $user['telefono'],
                    'email' => $user['email'],
                    'num_conductor' => $user['num_conductor'],
                    'uid_firebase'=> $uid
                ];
                $all_conductores [] = $con;
            }
        }*/
        $all_conductores = Conductor::all();
        return view('conductores.index', compact('all_conductores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->creaConductorFirebase($request);
        $data = $request->validate([
            'nombre' => 'required|max:255',
            'num_conductor' => 'required',
            'email' => 'required',
            'telefono' => 'required'
        ]);
        $data['uid_firebase'] = $user->uid;
        Conductor::create($data);

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conductor $conductor
     * @return \Illuminate\Http\Response
     */
    public function show(Conductor $conductor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conductor $conductor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conductor = Conductor::find($id);
        return view('conductores.edit', compact('conductor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Conductor $conductor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $conductor = Conductor::find($id);

        $this->updateUser($conductor->uid_firebase, $conductor);

        $conductor->update($datos);

        return redirect()->route('conductores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conductor $conductor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conductor = Conductor::find($id);
        $this->delUser($conductor->uid_firebase);
        $this->borraConductorFirebase($conductor->uid_firebase);
        $conductor->delete();
    }

    //Crear usuario firebase
    private function addUser($email, $password)
    {
        $firebase = $this->conectarFirebase();
        $auth = $firebase->getAuth();
        $userProperties = [
            'email' => $email,
            'emailVerified' => false,
            'password' => $password,
            'disabled' => false,
        ];
        $createdUser = $auth->createUser($userProperties);
        return $createdUser;
    }

    //Borrar usuario firebase
    private function delUser($uid)
    {
        $firebase = $this->conectarFirebase();
        $auth = $firebase->getAuth();
        $this->borraConductorFirebase($uid);
        $auth->deleteUser($uid);

    }

    //Actualizar usuario firebase
    private function updateUser($uid, $conductor)
    {
        $firebase = $this->conectarFirebase();
        $auth = $firebase->getAuth();

        $auth->changeUserEmail($uid, $conductor->email);

        $this->actualizaConductorFirebase($uid, $conductor);

    }


    // Conectar con firebase
    private function conectarFirebase()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/FirebaseKey.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://contabus.firebaseio.com')
            ->create();

        return $firebase;
    }


    //Crear conductor en firebase
    private function creaConductorFirebase($request)
    {
        $firebase = $this->conectarFirebase();

        $database = $firebase->getDatabase();

        $user = $this->addUser($request->email, $request->password);

        $ref = $database->getReference('conductores/' . $user->uid);

        $ref->set([
            'nombre' => $request->nombre,
            'num_conductor' => $request->num_conductor,
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);

        return $user;
    }

    //Borrar conductor firebase
    private function borraConductorFirebase($uid)
    {
        $firebase = $this->conectarFirebase();

        $database = $firebase->getDatabase();

        $ref = $database->getReference('conductores/' . $uid);

        $ref->remove();
    }

    //Actualizar conductor firebase
    private function actualizaConductorFirebase($uid, $conductor)
    {
        $firebase = $this->conectarFirebase();

        $database = $firebase->getDatabase();

        $ref = $database->getReference('conductores/' . $uid);

        $postData = [
            'nombre' => $conductor->nombre,
            'email' => $conductor->email,
            'num_conductor' => $conductor->num_conductor,
            'telefono' => $conductor->telefono,
        ];

        $ref->update($postData);
    }

    //Listado pdf
    public function pdf(){
        $conductores=Conductor::orderBy("num_conductor","DESC")->get();

        $pdf = PDF::loadView('conductores.pdf', compact('conductores'));
        return $pdf->download('conductores.pdf');
    }

    public function export()
    {
        return Excel::download(new ConductorExport, 'conductores.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new ConductorExport, 'conductores.csv');
    }
}
