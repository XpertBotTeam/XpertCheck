<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Client;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/user/Admin/index');
    }

    public function createEmployee()
    {
        return view('/user/Admin/createEmployee');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email',
            'password' => 'required|string|min:8',
            'salary' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $employee = new Employee();
        $employee->name = $validatedData['name'];
        $employee->email = $validatedData['email'];
        $employee->password = Hash::make($validatedData['password']);
        $employee->salary = $validatedData['salary'];
        $employee->user_id = $user->id;

        $employee->save();

        return redirect()->route('Employeeindex');
    }

    public function createProject()
    {
        $clients = Client::all();
        return view('/user/Admin/createProject', compact('clients'));
    }

    public function storeProject(Request $request)
    {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        if ($request->filled('client_id')) {
            $clientId = $request->input('client_id');
        }

        $project = new Project();
        $project->project_name = $validatedData['project_name'];
        $project->client_id = $clientId;
        $project->description = $validatedData['description'];
        $project->start_date = $validatedData['start_date'];
        $project->end_date = $validatedData['end_date'];
        $project->status = $validatedData['status'];

        $project->save();

        return redirect()->route('Projectindex');
    }

    public function createClient()
    {
        return view('/user/Admin/createClient');
    }

    public function storeClient(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $client = new Client();
        $client->name = $validatedData['name'];
        $client->email = $validatedData['email'];
        $client->password = Hash::make($validatedData['password']);
        $client->user_id = $user->id;

        $client->save();

        return redirect()->route('Clientindex');
    }

    public function indexEmployee()
    {
        $employees = Employee::all();
        return view('/user/Admin/Employee', ['employees' => $employees]);
    }

    public function indexClient()
    {
        $clients = Client::all();
        return view('/user/Admin/Client', ['clients' => $clients]);
    }

    public function indexProject()
    {
        $projects = Project::all();
        return view('/user/Admin/Project', ['projects' => $projects]);
    }

    public function destroyClient($id)
    {
        $client = Client::findOrFail($id);
        $client->projects()->delete();
        $client->delete();
        return redirect()->back()->with('success', 'Client deleted successfully');
    }

    public function editClient($id)
    {
        $client = Client::findOrFail($id);
        return view('/user/Admin/editClient', compact('client'));
    }

    public function updateClient(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
        ]);

        $client = Client::findOrFail($id);
        $client->update($validatedData);
        return redirect()->route('Clientindex')->with('success', 'Client updated successfully');
    }

    public function editEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('/user/Admin/editEmployee', compact('employee'));
    }

    public function updateEmployee(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $id,
            'salary' => 'required|numeric',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->name = $validatedData['name'];
        $employee->email = $validatedData['email'];
        $employee->salary = $validatedData['salary'];
        $employee->save();

        return redirect()->route('Employeeindex')->with('success', 'Employee updated successfully');
    }

    public function destroyEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('Employeeindex')->with('success', 'Employee deleted successfully');
    }

    public function destroyProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('Projectindex')->with('success', 'Project deleted successfully');
    }

    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        return view('/user/Admin/editProject', ['project' => $project]);
    }

    public function updateProject(Request $request, $id)
    {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validatedData);

        return redirect()->route('Projectindex')->with('success', 'Project updated successfully');
    }
}
