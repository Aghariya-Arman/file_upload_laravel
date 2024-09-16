<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('fileupload', compact('users'));
    }


    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $file = $request->file('photo');

        $request->validate([
            'photo' => 'required|mimes:png,jpg,jpeg'
        ]);

        $path = $request->file('photo')->store('image', 'public');
        User::create([
            'filename' => $path,
        ]);
        return redirect()->route('user.index')->with('status', ' uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $user = User::find($id);
        return view('fileupdate', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($request->hasFile('photo')) {

            $file_path = public_path("storage/") . $user->filename;
            if (fileExists($file_path)) {
                @unlink($file_path);
            }

            $path = $request->file('photo')->store('image', 'public');

            $user->filename = $path;
            $user->save();

            return redirect()->route('user.index')->with('status', ' Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        $file_path = public_path("storage/") . $user->filename;


        if (fileExists($file_path)) {
            @unlink($file_path);
        }
        return redirect()->route('user.index')->with('status', ' deleted successfully');
    }
}
