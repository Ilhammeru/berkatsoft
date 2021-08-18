<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\Validation;

use function PHPSTORM_META\map;

class AuthController extends Controller
{
    use validation;

    public function index() {
        return view('auth.login');
    }

    public function register(Request $request) {
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $request = $request->all();
        
        // identity
        $identity = ["username-register", 'email-register', 'password-register'];

        // validation 
        $validation = [
            'username' => 'required|min_6',
            'email' => 'required',
            'password' => 'required|min_8|alphaNum',
            'request' => $request
        ];

        $valid = $this->validation($validation);

        if (count($valid['error']) == 0) {
            $check = User::whereRaw("JSON_CONTAINS(detail, JSON_QUOTE('$email'), '$.email') = 1 OR username = '$username'")->count();
    
            if ($check > 0) {
                $data = [
                    "error" => [
                        "username" => ["Email or Username is existed"],
                        "email" => ["Email or Username is existed"]
                    ]
                ];
                $attr['status'] = "500";
                $attr['message'] = "something wrong";
                $attr['data'] = $data;
            } else {
                //save
                if ($request['phone'] != "") {
                    $phone = $request['phone'];
                } else {
                    $phone = "";
                }

                if ($request['address'] != "") {
                    $address = $request['address'];
                } else {
                    $address = "";
                }

                if ($request['role'] != "") {
                    $reqRole = $request["role"];
                } else {
                    $reqRole = 1;
                }

                $detail = [
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address
                ];
                $save = [
                    'username' => $username,
                    'password' => Hash::make($password),
                    'role' => $reqRole,
                    'detail' => json_encode($detail),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
    
                $id = DB::table('user')->insertGetId($save);
    
                if (!empty($id)) {
                    $attr['status'] = "200";
                    $attr['data'] = ['id' => $id];
                    $attr['message'] = "User successfully stored";
                } else {
                    $attr['status'] = "500";
                    $attr['data'] = array();
                    $attr['message'] = "Something wrong";
                }
            }
        } else {
            $attr['status'] = "500";
            $attr['message'] = "Something wrong";
            $attr['data'] = $valid;
        }

        echo json_encode($attr);
    }

    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $all = $request->all();

        $validation = [
            'username' => 'required',
            'password' => 'required',
            'request' => $all
        ];

        $valid = $this->validation($validation);

        if (count($valid['error']) == 0) {
            $check = User::select(['id', 'username', 'detail', 'password', 'role', 'status'])
                        ->whereRaw("username = '$username'")
                        ->first();

            if (empty($check)) {
                $err = [
                    "error" => [
                        "username" => ["Username is not registered"]
                    ]
                ];
                $status = "500";
                $message = "User is not registered";
                $data = $err;
            } else {
                // check status 
                if ($check->status == "0") {
                    $err = [
                        "error" => [
                            "username" => ["Your account is not active, please contact your admin"]
                        ]
                    ];
                    $status = "500";
                    $message = "Your account is not active, please contact your admin";
                    $data = $err;
                } else {
                    // check password
                    if (Hash::check($password, $check->password)) {
                        $detail = json_decode($check->detail, TRUE);

                        if ($check->role == '2') {
                            $roles = "admin";
                        } else if ($check->role == "1") {
                            $roles = "customer";
                        }

                        // session
                        $request->session()->put('id', $check->id);
                        $request->session()->put('email', $detail['email']);
                        $request->session()->put('role', $roles);
                        $request->session()->put('username', $check->username);

                        $email = $detail['email'];
                        $url = "/dashboard";

                        $status = "200";
                        $message = $email;

                        $data = ["email" => $email, "url" => $url];
                    } else {
                        $err = [
                            "error" => [
                                "password" => ["Password wrong"]
                            ]
                        ];
                        $status = "500";
                        $message = "Password wrong";
                        $data = $err;
                    }
                }
            }
        } else {
            $status = "500";
            $message = "Something wrong";
            $data = $valid;
        }

        $attr['status'] = $status;
        $attr['message'] = $message;
        $attr['data'] = $data;

        echo json_encode($attr);
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect('/');
    }
}
