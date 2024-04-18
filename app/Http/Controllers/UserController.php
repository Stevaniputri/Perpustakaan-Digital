<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; 
use Dompdf\Dompdf;
use Dompdf\Options;

class UserController extends Controller
{
    private function generatePDF($view, $data, $filename)
    {

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view($view, $data)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($filename);
    }

    public function userlist()
    {
        $dataUser = User::all();
        return view('User.userlist', compact('dataUser'));
    }

    public function exportUsersPDF()
    {
        $users = User::all();
        return $this->generatePDF('pdf.user', compact('users'), 'users.pdf');
    }
    
    public function addUser()
    {
        return view('User.add');
    }

    public function editUser($id)
    {
        $users = User::where('id', $id)->first();
        return view('User.edit', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:3|max:30',
            'username' => 'required',
            'email' => 'required',
            'address' => 'required',
            'password' => 'required',
            'role' => ['required', Rule::in(['admin', 'petugas', 'peminjam'])], 
        ]);

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('userlist')->with('success', "Berhasil membuat user");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|min:3|max:30',
            'username' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'nullable',
            'role' => ['required', Rule::in(['admin', 'petugas', 'peminjam'])], 
        ]);

        $userData = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'role' => $request->role,
        ];

        // Hanya jika ada kata sandi yang diberikan, kita tambahkan ke array data pengguna
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($userData);

        return redirect()->route('userlist')->with('success', "Berhasil memperbarui user");
    }

    public function destroy($id)
    {
        User::where('id', '=', $id)->delete();
        return redirect()->back();
    }
}
