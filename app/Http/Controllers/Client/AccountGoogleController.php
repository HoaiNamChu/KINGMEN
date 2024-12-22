<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\Address;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

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


    // View detail account
    public function index()
    {
        $user = Auth::user(); 

        if ($user) {
            // Lấy dữ liệu của người dùng theo ID
            $userData = User::find($user->id);
        } else {
            return redirect()->route('login'); // Redirect đến trang đăng nhập 
        }
        $addresses = Address::where('user_id', $user->id)->get();
        return view('client.account.index', compact('userData', 'addresses', 'user'));
    }

    
    // register
    public function create()
    {
        return view('client.account.register');
    }

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
        return redirect()->intended('/');
    }

    // view login
    public function viewLogin()
    {
        return view('client.account.login');
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

    // Update address default
    public function setDefault($id)
    {
        $user = auth()->user();

        // Cập nhật địa chỉ mặc định
        Address::where('user_id', $user->id)->update(['is_default' => false]); // Gỡ mặc định các địa chỉ khác
        Address::where('id', $id)->where('user_id', $user->id)->update(['is_default' => true]);

        return redirect()->back()->with('success', 'The default address has been changed!');
    }


    public function storeAddress(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'detailed_address' => 'required|string|max:500',
            'phone' => 'required|regex:/^\d{10}$/',
            'is_default' => 'nullable|in:true,false,1,0',
        ]);
    
        $user = auth()->user();
    
        // CHưa có địa chỉ láy địa chỉ đầu làm mặc đinh
        $isFirstAddress = Address::where('user_id', $user->id)->doesntExist();
    
        // Nếu là địa chỉ mặc định, bỏ mặc định các địa chỉ khác
        if ($request->boolean('is_default') || $isFirstAddress) {
            Address::where('user_id', $user->id)->update(['is_default' => false]);
        }
    
        Address::create([
            'user_id' => $user->id,
            'city' => $request->city,
            'district' => $request->district,
            'ward' => $request->ward,
            'detailed_address' => $request->detailed_address,
            'phone' => $request->phone,
            'is_default' => $request->boolean('is_default', false) || $isFirstAddress,
        ]);
    
        return redirect()->back()->with('success', 'New address added successfully!');
    }
    
    

    // delete address
    public function deleteAddress($id)
    {
        $address = Address::find($id);
    
        if (!$address) {
            return response()->json(['error' => 'Địa chỉ không tồn tại'], 404); 
        }
    
        if ($address->is_default) {
            return redirect()->back()->with('error', 'Default address could not delete!');
        }
    
        // Xóa địa chỉ
        $address->delete();
        return redirect()->back()->with('success', 'Address deleted successfully!');
    }
    

    // Forget password
    public function showForgetPasswordForm()
    {
        return view('client.account.viewForgetPassword');
    }

    public function sendEmailForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email', // Ensure the email exists in the users table
        ]);

        try {
            // random token
            $token = Str::random(64);

            // Insert token vào bảng password_reset_tokens
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            // Send email
            Mail::send('client.email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return back()->with('success', 'We have e-mailed your password reset link!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }


    public function showResetPasswordForm($token) {
        return view('client.account.formResetPassword', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        // Check token đã được tạo chưa
        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        // token chưa dc tạo báo lỗi
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token or the link has expired!');
        }

        // Update password
        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        // xóa token khi password được cập nhật
        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        // SAu khi Update password tự động login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/')->with('message', 'Password updated successfully');
        }

        return redirect('/login')->with('error', 'There was an issue logging in. Please try logging in manually.');
    }


}
