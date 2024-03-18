<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::all();
        $projects = Project::all();
        return view('/user/Client/index', ['projects' => $projects,'employees' => $employees]);
    }

    public function createEmployee()
    {
        return view('/user/Client/createEmployee');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'salary' => 'required|numeric',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Get the client ID of the authenticated user
        $clientId = auth()->id();

        // Create the associated employee
        $employee = new Employee();
        $employee->name = $user->name;
        $employee->email = $user->email;
        $employee->password = $user->password;
        $employee->salary = $validatedData['salary'];
        $employee->user_id = $user->id;
        $employee->client_id = $clientId;
        $employee->save();

        // Redirect to a success page or wherever needed
        return redirect()->route('user.index')->with('success', 'User and Employee created successfully!');
    }

    public function createProject()
    {
        return view('/user/Client/createProject');
    }

    public function storeProject(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        // Create the project
            Project::create([
        'project_name' => $validatedData['project_name'],
        'description' => $validatedData['description'],
        'start_date'=> $validatedData['start_date'],
        'end_date'=> $validatedData['start_date'],
        'status'=> $validatedData['status'],
        'client_id' => auth()->id(), // Assign the client ID from the authenticated user
        ]);
       // Redirect to a success page or wherever needed
        return redirect()->route('user.index');
    }

}
