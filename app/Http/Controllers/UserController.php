<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  
    //
    public function index(Request $request){
    if (!auth()->check()) {
        return redirect()->route('login'); // redirect to login if not logged in
    }
      
        $search = $request->search;

    $users = User::where('id', '!=', Auth::id())
    ->when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'LIKE', "%{$search}%")
              ->orWhere('last_name', 'LIKE', "%{$search}%");
        });
    })
    ->get();
          
    return view('admin.user.table', compact('users'));
       
    }

    public function store(Request $request)
    {
        $request->validate([
        'first_name' => 'required|string|max:100',
        'middle_initial' => 'nullable|string|max:1',
        'last_name' => 'required|string|max:100',
        'extension' => 'nullable|string|max:10',
        'contact_number' => 'required|string|max:20',
        'email' => 'required|email|unique:users',
        'birthday' => 'required|date',
        'province' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'street'=> ' required',
        'postal_code'=> 'required',
        'barangay' => 'required|string|max:255',
        'user_type' => 'required|in:user,admin,super_admin',
        'password' => 'required|min:6|confirmed',
        ]);

         User::create([
        'first_name' => $request->first_name,
        'middle_initial' => $request->middle_initial,
        'last_name' => $request->last_name,
        'extension' => $request->extension,
        'contact_number' => $request->contact_number,
        'email' => $request->email,
        'birthday' => $request->birthday,
        'province' =>$request->province,
        'city' =>$request->city,
        'street' =>$request->street,
        'postalcode'=> $request->postal_code,
        'barangay' =>$request->barangay,
        'user_type' => $request->user_type,
        'password' => Hash::make($request->password),
        'status'=> 1,
        ]);

       return redirect()->back()->with('success', 'User added successfully!');
    }

    public function view($id){

        $user = User::findOrFail($id);
        return view('admin.user.view', compact('user'));
    }

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id); // make sure the user exists

    $request->validate([
        'fname' => 'required|string|max:255',
        'mname' => 'nullable|string|max:255',
        'lname' => 'required|string|max:255',
        'contact_number' => 'nullable|string|max:15',
        'birthday' => 'nullable|date',
        'user_type' => 'required|in:super_admin,admin,user',
        'status' => 'required|in:0,1,2',
    ]);

    $user->first_name = $request->fname;
    $user->middle_initial = $request->mname;
    $user->last_name = $request->lname;
    $user->contact_number = $request->contact_number;
    $user->birthday = $request->birthday;
    $user->user_type = $request->user_type;
    $user->status = $request->status;

    // Make sure email exists in the model
    if(!$user->email) {
        $user->email = $request->email ?? 'default@example.com'; // temporary default if needed
    }

    $user->save();

   return redirect()->back()->with('success', 'User Edited successfully!');
}
    public function Address(Request $request, $id)
    {
        $user = User::findOrFail($id);
         $request->validate([
        'province' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'street'=> ' required',
        'postal_code'=> 'required',
        'barangay' => 'required|string|max:255',
    ]);

    $user->province = $request->province;
    $user->city = $request->city;
    $user->barangay = $request->barangay;
    $user->postalcode = $request->postal_code;
    $user->street = $request->street;

    $user->save();

    return redirect()->route('useredit.index')->with('success', 'User Address updated successfully!');

    }

    public function destroy($id)
{
    $data = User::findOrFail($id);
    $data->delete();

    return redirect()->back()->with('success', 'Record deleted successfully.');
}

}
