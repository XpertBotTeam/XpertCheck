<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Client;
use App\Models\Role;

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

   
    //------------------------------------Client---------------------------------------------------
   
    public function createClient()
    {
        $users=User::all();
        return view('/user/Admin/createClient',['users'=>$users]);
    }

    public function storeClient(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Check uniqueness against the users table
            'password' => 'required|string|min:8',
        ]);
    
        try {
            // Create the user
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();
    
            // Create the client using the user's id
            $client = new Client();
           // $client->name = $validatedData['name']; // Set client name from user's name
            $client->user_id = $user->id; // Associate the client with the user
    
            // Save the client
            $client->save();
    
            return redirect()->route('Clientindex')->with('success', 'Client created successfully');
        } catch (\Exception $e) {
            //\Log::error('Failed to create client: ' . $e->getMessage());
           // dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create client']);
        }
    }
    
    public function indexClient()
    {
        $clients = Client::all();
        return view('/user/Admin/Client', ['clients' => $clients]);
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
        // Find the client by ID
        $client = Client::findOrFail($id);
    
        // Retrieve the user associated with the client
        $user = User::findOrFail($client->user_id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
    
        // Update the user's name and email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        // Save the changes to the user
        $user->save();
    
        // Redirect with success message
        return redirect()->route('Clientindex')->with('success', 'Client updated successfully');
    }
//-----------------------Employee------------------------
    public function indexEmployee()
    {
        $employees = Employee::all();
        return view('/user/Admin/Employee', ['employees' => $employees]);
    }

    public function editEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('/user/Admin/editEmployee', compact('employee'));
    }


    public function updateEmployee(Request $request, $id)
    {
        // Find the employee by ID
        $employee = Employee::findOrFail($id);
    
        // Retrieve the user associated with the employee
        $user = User::findOrFail($employee->user_id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'salary' => 'required|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
        ]);
    
        // Update the user's name and email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        // Save the changes to the user
        $user->save();
    
        // Update the employee's salary
        $employee->salary = $validatedData['salary'];
    
        // Save the changes to the employee
        $employee->save();
    
        // Redirect with success message
        return redirect()->route('Employeeindex')->with('success', 'Employee updated successfully');
    }
    
    public function createEmployee()
    {
        return view('/user/Admin/createEmployee');
    }

    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'salary' => 'required|numeric',
        ]);
        
        //dd($validatedData);

        try {
            // Create or find the user
            $user = User::firstOrCreate(
                ['email' => $validatedData['email']],
                [
                    'name' => $validatedData['name'],
                    'password' => Hash::make($validatedData['password']),
                ]
            );
    
            // Create the employee
            $employee = new Employee();
            $employee->salary = $validatedData['salary'];
            $employee->user_id = $user->id;
    
            // Save the employee
            $employee->save();
    
            return redirect()->route('Employeeindex')->with('success', 'Employee created successfully');
        } catch (\Exception $e) {
           // dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create employee']);
        }
    }
    

    public function destroyEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('Employeeindex')->with('success', 'Employee deleted successfully');
    }
//----------------------------------------Project-----------------------------------------
    

   
public function createProject()
{
    $clients = Client::all();
    return view('/user/Admin/createProject', compact('clients'));
}

public function storeProject(ProjectRequest $request)
{
    // The validated data will be available as $request->validated()
    $validatedData = $request->validated();

    $project = new Project();
    $project->project_name = $validatedData['project_name'];
    $project->client_id = $validatedData['client_id'];
    $project->description = $validatedData['description'];
    $project->start_date = $validatedData['start_date'];
    $project->end_date = $validatedData['end_date'];
    $project->status = $validatedData['status'];
    $project->latitude = $validatedData['latitude'];
    $project->longitude = $validatedData['longitude'];
    $project->radius = $validatedData['radius'];

    $project->save();

    return redirect()->route('Projectindex')->with('success', 'Project created successfully');
}

public function indexProject()
{
    $projects = Project::all();
    return view('/user/Admin/Project', ['projects' => $projects]);
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
    $clients = Client::all(); // Fetch clients to be used in the edit form
    return view('/user/Admin/editProject', ['project' => $project, 'clients' => $clients]);
}

public function updateProject(Request $request, $id)
{
    $validatedData = $request->validate([
        'project_name' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'status' => 'required|in:active,completed,on_hold',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'radius' => 'nullable|numeric',
    ]);

    $project = Project::findOrFail($id);
    $project->update($validatedData);

    return redirect()->route('Projectindex')->with('success', 'Project updated successfully');
}
//--------------Role-----------------------------------------------------------------
    public function indexRole()
    {
        $users = User::all(); // Fetch users from the database
        $roles = Role::all();
        return view('/user/Admin/Role', ['users' => $users, 'roles' => $roles]);
    }


    public function createRole()
    {
        return view('/user/Admin/createRole');
    }

    public function storeRole(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Validate that the user_id exists in the users table
            'role_id' => 'required|exists:roles,id', // Validate that the role_id exists in the roles table
        ]);
    
        // Attach the role to the user
        $user = User::find($validatedData['user_id']);
        $user->roles()->attach($validatedData['role_id']);
    
        return redirect()->route('Roleindex')->with('success', 'Role assigned successfully');
    }
    

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        return view('/user/Admin/editRole', ['role' => $role]);
    }

    public function updateRole(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            // Add validation rules for other role attributes if needed
        ]);

        $role = Role::findOrFail($id);
        $role->update($validatedData);

        return redirect()->route('Roleindex')->with('success', 'Role updated successfully');
    }

    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('Roleindex')->with('success', 'Role deleted successfully');
    }

    public function assignRole(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');

        // Add logic to assign the role to the user
        $user = User::find($userId);
        $user->roles()->attach($roleId);

        // Check if the user should become a client or employee
        if ($user->hasRole('client')) {
            // Create a new client record for the user
            $client = new Client();
            $client->user_id = $userId;
            // Add other client data if needed
            $client->save();
        } elseif ($user->hasRole('employee')) {
            // Create a new employee record for the user
            $employee = new Employee();
            $employee->user_id = $userId;
            // Add other employee data if needed
            $employee->save();
        }

        return redirect()->back()->with('success', 'Role assigned successfully');
    }
}