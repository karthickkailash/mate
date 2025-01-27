<?php

namespace App\Http\Controllers\Api\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Tenant;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function companyList(Request $request)
    { 
    // Decrypt the incoming data
    //$decryptedData = $this->cryptoService->decrypt($request->input('data'));

    // If decryption fails, return an error response
    // if (!$decryptedData) {
    //     return response()->json([
    //         'message' => 'Invalid or tampered data',
    //     ], 400);
    // }

    // Validate the email field
    //$request->merge(json_decode($decryptedData, true)); // Merge decrypted data into the request
    if (isset($request->request_data)) {
        $data = $this->decryption($request->request_data); //LIPSODIUM Decrypt call
        $convert_arr = json_decode(json_encode($data), true); //Converted Request
        $request = new Request($convert_arr); //Assigned to new request
    }
    $request->validate([
        'email' => 'required|string|email|max:255',
    ]);
    
    // Fetch the user from the Company table
    $user = Company::where('company_email', $request->email)->get();
    //$encryptedData = $this->cryptoService->encrypt($user);
    // Return the response
    return response()->json([
        'message' => 'Data fetched successfully!',
        "data" => $this->encryption(json_encode($user)),
    ]);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function medd()
{
    // Get the authenticated user
    //$user = auth()->user();
    // Find the tenant by domain or another identifier
    $user = JWTAuth::parseToken()->authenticate();


    $tenant = Tenant::find($user->tenant_id); // Adjust based on your implementation

    // Initialize tenancy
    if ($tenant) {
        tenancy()->initialize($tenant);

        // Fetch company within tenant context
        $company = \App\Models\Company::find($user->company_id);

        return response()->json([
            'message' => 'Data fetched successfully!',
            'company' => $company,
        ]);
    }

    return response()->json([
        'message' => 'Tenant not found or tenancy not initialized.',
    ], 404);
}

// public function me()
// {
//     // $token = $request->bearerToken();
//     // $user = JWTAuth::parseToken()->authenticate();
//     // dd($user);
//     // return response()->json([
//     //     'message' => 'Authenticated user retrieved successfully!',
//     //     'user' => $user,
//     // ]);
//     try {
//         $token = JWTAuth::parseToken();  
//             if ($token->check()) {
//                 $payload = JWTAuth::parseToken()->getPayload();
//                 $auth_user = (object)$payload->get('user'); 
//             }
//             $domain = $auth_user->name;
//             $tenant = Tenant::where('id', $domain)->first();
//             if ($tenant) {
//                 // Set tenant context
//                 tenancy()->initialize($tenant);
                
//             }
//             $user = Company::where('company_name', $auth_user->name)->get();
//         return response()->json([
//             'message' => 'Token is valid',
//             'user' => $user
//         ]);
//     } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
//         return response()->json(['error' => 'Token has expired'], 401);
//     } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
//         return response()->json(['error' => 'Token is invalid'], 401);
//     } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
//         return response()->json(['error' => 'Token is missing'], 401);
//     }
// }
public function me() {
    try {
        // Parse the JWT token from the request
        $token = JWTAuth::parseToken();
    
        // Check if the token is valid
        if (!$token->check()) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    
        // Get the payload from the token
        $payload = $token->getPayload();
    
        // Retrieve the user object from the payload
        $auth_user = (object) $payload->get('user');
        if (!isset($auth_user->name)) {
            return response()->json(['error' => 'User name not found in token payload'], 400);
        }
    
        // Retrieve the tenant based on the user domain (name in this case)
        $tenant = Tenant::where('id', $auth_user->name)->first();
    
        // If no tenant is found, return an error response
        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found'], 404);
        }
    
        // Set the tenant context
        tenancy()->initialize($tenant);
    
        // Retrieve the company data based on the authenticated user's name
        $user = Company::where('company_name', $auth_user->name)->get();
    
        // Return the response with the user data
        return response()->json([
            'message' => 'Token is valid',
            'user' => $user,
        ]);
    
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        // Handle expired token exception
        return response()->json(['error' => 'Token has expired'], 401);
    
    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        // Handle invalid token exception
        return response()->json(['error' => 'Token is invalid'], 401);
    
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        // Handle other JWT-related exceptions
        return response()->json(['error' => 'Token is missing or malformed'], 400);
    
    } catch (\Exception $e) {
        // Catch any other exceptions
        return response()->json(['error' => 'An error occurred', 'details' => $e->getMessage()], 500);
    }
}
    public function table_migration(Request $request)
    {
        // Find the tenant
    $tenant = Tenant::find($request->tenant);

        if ($tenant) {
        // Initialize the tenant context
        tenancy()->initialize($tenant);

        // Run rollback for this tenant
        // Artisan::call('migrate:rollback', [
        //     '--path' => 'database/migrations/tenant',
        //     '--force' => true,
        // ]);
        Artisan::call('migrate', [
            '--path' => 'database/migrations/tenant',
        ]);

            echo "Rollback successful for tenant: " . $tenant->id;
        } else {
            echo "Tenant not found.";
        }
    }

//     public function table_migration(Request $request)
// {
//     // Find the tenant
//     $tenant = Tenant::find($request->tenant);

//     if ($tenant) {
//         // Initialize the tenant context
//         tenancy()->initialize($tenant);

//           // Get the database connection for the tenant
//           $connection = DB::connection();
          
//        // Get the list of existing tables
//        $existingTables = $connection->getDoctrineSchemaManager()->listTableNames(); 

//         // Get all migration files from the tenant's migration path
//         $migrationPath = database_path('migrations/tenant');
//         $migrationFiles = glob($migrationPath . '/*.php');

//         foreach ($migrationFiles as $migrationFile) {
//             // Extract the class name from the migration file
//             require_once $migrationFile;
//             $className = pathinfo($migrationFile, PATHINFO_FILENAME);

//             if (!class_exists($className)) {
//                 continue; // Skip if class does not exist
//             }

//             // Initialize the migration class and check its `up` method
//             $migrationInstance = new $className();
//             if (method_exists($migrationInstance, 'up')) {
//                 // Run the migration only if the table does not already exist
//                 $tableName = $this->getTableNameFromMigration($migrationInstance);
//                 if ($tableName && !in_array($tableName, $existingTables)) {
//                     // Run the migration
//                     $migrationInstance->up();
//                     echo "Migrated table: $tableName<br>";
//                 } else {
//                     echo "Table already exists: $tableName<br>";
//                 }
//             }
//         }
//     } else {
//         echo "Tenant not found.";
//     }
// }

/**
 * Extract the table name from the migration's `up` method.
 *
 * @param object $migrationInstance
 * @return string|null
 */
// private function getTableNameFromMigration($migrationInstance)
// {
//     $reflection = new \ReflectionClass($migrationInstance);
//     $upMethod = $reflection->getMethod('up');
//     $code = file($upMethod->getFileName());
//     $start = $upMethod->getStartLine() - 1;
//     $end = $upMethod->getEndLine();
//     $lines = array_slice($code, $start, $end - $start);

//     foreach ($lines as $line) {
//         // Look for the `Schema::create` statement
//         if (preg_match("/Schema::create\('(.+?)'/", $line, $matches)) {
//             return $matches[1];
//         }
//     }

//     return null; // Return null if table name cannot be found
// }




}