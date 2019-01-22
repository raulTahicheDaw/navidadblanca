<?php

namespace App\Http\Controllers;

use App\Conductor;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ConductoresController extends Controller
{

    public function index()
    {
        /*

        $firebase = $this->conectarFirebase();

        $database = $firebase->getDatabase();
        $ref = $database->getReference('conductores');

        $conductores = $ref->getValue();

        foreach ($conductores as $user) {
            $con = [
                'nombre' => $user['nombre'],
                'telefono' => $user['telefono'],
                'email' => $user['email'],
                'num_conductor' => $user['num_conductor']
            ];
            $all_conductores [] = $con;
        }
        */



    }

    public function addConductor(Request $request)
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

    }

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

    private function conectarFirebase()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/FirebaseKey.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://contabus.firebaseio.com')
            ->create();

        return $firebase;
    }

}
