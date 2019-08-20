<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    public function index(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/my-academy-2805d-bf9af89d98e3.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $db = $firebase->getDatabase();
        $no = rand(10,100);
        $user = [
            'name' => 'My Application'.$no,
            'emails' => 'helo',
            'website' => 'https://app.domain.tld',
        ];
        $db->getReference('users')->push($user);;
        // $reference = $db->getReference('config/website');
        // $value = $reference->getValue();
        // echo '<h1> NEw row inserted .'.$value['emails'].' </h1>';


    }
}
