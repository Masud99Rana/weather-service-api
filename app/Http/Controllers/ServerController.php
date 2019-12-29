<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index() {
    	
    	return response()->json([
	    	'success' => true,
	    	'message' => "Welcome to my ". config('app.name') ." API",
            'Project Name' => config('app.name'),
            'Project Details' => 'This is one of my practices API project',
	    	'Developer' => 'Masud Rana',
	    	'Contact' => 'masud.letscode@gmail.com'
    	]);

    }

    public function ping() {
    	$appName = config('app.name');
        return $this->sendResponse($appName. " is ready to go...");
    }

    public function version() {
    	// Here,
    	// i just get version from file system. 
    	// I know i can get version from other file/ custom variable in the system, etc.
        if (file_exists(base_path('version.txt'))) {

        	$version = file_get_contents(base_path('version.txt'));
            return $this->sendResponse("The current version is ".$version);
        }

        $version = "dev";
        return $this->sendResponse("The current version is ".$version);
    }
}
