<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

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
        // Lấy thông tin người dùng từ Google thông qua Socialite
        $user = Socialite::driver('google')->user();

        // Tìm người dùng trong cơ sở dữ liệu dựa trên email của họ
        $finduser = User::where('email', $user->email)->first();

        // Nếu người dùng đã tồn tại và google_id của họ không rỗng
        if($finduser && !empty($finduser->google_id)){
            // Đăng nhập người dùng
            Auth::login($finduser);
            return redirect()->intended('/');  // Chuyển hướng đến trang chủ (hoặc trang mong muốn)
        } else if($finduser && empty($finduser->google_id)){
            // Nếu google_id rỗng, không đăng nhập
            return redirect()->back()->with('error', 'This account is not linked with Google. Please use another login method.');
        } else {
            // Nếu người dùng chưa tồn tại, tạo người dùng mới với thông tin từ Google
            $newUser = User::updateOrCreate(['email' => $user->email], [
                'username' => $user->name,
                'google_id'=> $user->id,
                'password' => encrypt('12345678')  // Mật khẩu mặc định
            ]);

            // Đăng nhập người dùng mới
            Auth::login($newUser);
            return redirect()->intended('/');
        }
    } catch (Exception $e) {
        // Nếu xảy ra lỗi, hiển thị thông báo lỗi (debugging)
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
            'username' => $request->username,
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

    public function login(Request $request)
    {
        // Xác thực input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Kiểm tra email hợp lệ
            'password' => 'required|string|min:6', // Mật khẩu ít nhất 6 ký tự
        ]);

        // Nếu xác thực thất bại
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lấy thông tin đăng nhập từ form
        $user = $request->only('email', 'password');

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $user['email'], 'password' => $user['password']], $request->has('remember'))) {
            // Nếu đúng, chuyển hướng đến trang mong muốn sau khi đăng nhập
            return redirect()->intended('/');
        }

        // Nếu thông tin sai, quay lại với thông báo lỗi
        return redirect()->back()->withErrors(['login_error' => 'The provided user are incorrect.'])->withInput();
    }



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
