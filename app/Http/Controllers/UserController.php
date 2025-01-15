<?php
// haii awalnya mau mainan database tp gajadi deh hehe :D
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function showRegisterCustomer()
    {
        return view('register');
    }

    public function showLoginCustomer()
    {
        return view('login');
    }

    public function index()
    {
        $totalProducts = DB::table('sukses_marts')->count();      
        $totalFood = DB::table('menus')->count();  
        $totalCustomer = DB::table('customers')->count();
        $totalPurchases = DB::table('customers')->sum('purchase_count');        
    
        return view('dashboard', compact('totalProducts','totalFood','totalCustomer','totalPurchases'));
    }

    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return redirect()->route('login')->with('success', 'Account created successfully!');
    }//

    public function loginCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid credentials!');
        }

        if ($user && $user->isEmployee) {
            Session::put('isEmployee', true);
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name); 
            return redirect()->route('dashboard')->with('success', 'Login successful as employee!');
        } elseif ($user && !$user->isEmployee) {
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name); 
            return redirect()->route('menu')->with('success', 'Login successful as user!');
        }
         else {
            return redirect()->back()->with('error', 'Error!');
           
        }

       
    }

    public function logout(){
        session()->flush();
        return redirect()->route('login')->with('success', 'Logged out!');
    }
    
    
}
