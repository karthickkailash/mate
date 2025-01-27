<?php

namespace App\Http\Controllers\Api\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Models\Domain;
use App\Models\Tenant;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    
    public function login(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'tenant' => 'required',
    ]);

    $domain = $request->tenant;
    $tenant = Tenant::where('id', $domain)->first();
    if ($tenant) {
        // Set tenant context
        tenancy()->initialize($tenant);
    } else {
        return response()->json([
            'message' => 'Tenant Not Found',
        ]);
    }
    // Attempt to authenticate the user with the provided credentials
    $credentials = $request->only('email', 'password');
    $user = Auth::attempt($credentials);

    // If authentication fails
    if (!$user) {
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }

    // Retrieve the authenticated user
    $user = Auth::user();

    // Generate a token with custom claims (including all user details)
    $token = Auth::claims([
        'user' => $user, // This includes all user details in the token
    ])->attempt($credentials);

    
    // Return the token and user details
    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
        'user' => $user, // Return user details as part of the response
    ]);
}






public function register(Request $request)
{
    try {
        // Initialize variables
        $domain_name = !empty($request->domain_name) ? $request->domain_name : '';
        $base_domain = config('app.domain');
        $sub_domain = $domain_name . '.' . $base_domain;

        // Check if tenant domain already exists
        $tenantExist = DB::table('domains')->where('domain', $domain_name)->count();

        if ($tenantExist > 0) {
            return response()->json(['code' => 422, 'message' => 'Tenant name already exists'], 422);
        }

        // Create the tenant
        $tenant = Tenant::create(['id' => $domain_name]);

        if ($tenant) {
            $tenant = Tenant::find($domain_name);

            // Assign the domain to the tenant
            $domain = new Domain(['domain' => $sub_domain]);
            $tenant->domains()->save($domain);

            // Initialize tenant context
            tenancy()->initialize($tenant);

            // Migrate the tenant's database
            Artisan::call('tenants:migrate', [
                '--tenants' => [$tenant->id],
            ]);

            // Create the user within the tenant context
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id' => $request->company_id,
                'branch_id' => $request->branch_id,
            ]);

            // Send welcome email
            // try {
            //     $messageBody = "Welcome to our platform, {$user->name}!";
            //     Mail::raw($messageBody, function ($message) use ($user) {
            //         $message->from('diod89646@gmail.com', 'Your Company'); // Replace with your sender email and name
            //         $message->to($user->email)->subject('Welcome to Our Platform');
            //     });

            //     // Check for mail failures
            //     if (Mail::failures()) {
            //         return response()->json(['message' => 'User created successfully, but failed to send email'], 500);
            //     }
            // } catch (\Exception $e) {
            //     return response()->json(['message' => 'User created successfully, but failed to send email', 'error' => $e->getMessage()], 500);
            // }

            // Return success response
            return response()->json([
                'message' => 'User created successfully, tenant database created, and email sent!',
                'user' => $user,
            ], 201);
        } else {
            return response()->json(['code' => 500, 'message' => 'Tenant creation failed!'], 500);
        }
    } catch (\Exception $e) {
        // Handle exceptions globally
        return response()->json([
            'code' => 500,
            'message' => 'An error occurred during tenant registration.',
            'error' => $e->getMessage(),
        ], 500);
    }
}




    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

   

    

    
}