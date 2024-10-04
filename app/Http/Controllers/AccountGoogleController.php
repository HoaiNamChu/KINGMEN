<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AccountGoogleController extends Controller
{
    // login by google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();     
            $finduser = User::where('google_id', $user->google_id)->first();
         
            if($finduser){
                Auth::login($finduser);        
                return redirect()->intended('/');         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'google_id'=> $user->id,
                        'password' => encrypt('12345678')
                    ]);
         
                Auth::login($newUser);       
                return redirect()->intended('/');
            }        
            } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    // logout
    public function logout(Request $request)
    {
        // Đăng xuất người dùng khỏi session
        Auth::logout();

        // Xóa session để đảm bảo người dùng đã đăng xuất
        $request->session()->invalidate();

        // Tạo lại session token để bảo vệ an toàn
        $request->session()->regenerateToken();

        return redirect('/');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); 

        if ($user) {
            // Lấy dữ liệu của người dùng theo ID
            $userData = User::find($user->id);
        } else {
            return redirect()->route('login'); // Redirect đến trang đăng nhập 
        }

        return view('client.home.account.index', compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.home.account.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Kiểm tra tính duy nhất của email
        ]);

        // Kiểm tra nếu xác thực thất bại
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);

        // Đăng nhập ngay lập tức (tuỳ chọn)
        Auth::login($user);

        // Chuyển hướng đến trang thành công
        return redirect()->route('account.index')->with('success', 'Đăng ký thành công!');
    }

    public function viewLogin()
    {
        return view('client.home.account.login'); 
    }

    // public function login(Request $request)
    // {
    //     // Xác thực dữ liệu đầu vào
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Kiểm tra thông tin đăng nhập
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         // Đăng nhập thành công, chuyển hướng đến trang mong muốn
    //         return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
    //     }

    //     // Đăng nhập thất bại, quay lại với thông báo lỗi
    //     return redirect()->back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput();
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
