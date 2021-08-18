<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Validation;
use Carbon\Carbon;

class CustomerController extends Controller
{

    use validation;

    public function getCustomer(Request $request) {
        $page = $request->page;
        $perPage = 10;

        if ($page != 0) {
            $page = ($page - 1) * $perPage;
        }

        $totalData = DB::table('user')
            ->select('id')
            ->whereRaw("status > 0 AND role = 1")
            ->count();

        $totalPage = ceil($totalData / $perPage);

        $data = DB::table('user')
            ->select(['username', 'id', 'status', 'detail'])
            ->whereRaw("status > 0 AND role = 1")
            ->skip($page)
            ->take($perPage)
            ->get();

        $return['data'] = $data;

        $pagination['currentPage'] = $page + 1;
        $pagination['totalPage'] = $totalPage;
        $pagination['lastPage'] = $totalPage;
        $pagination['table'] = "user";
        $pagination['condition'] = "status > 0 AND role = 1";
        $pagination['tableTarget'] = "target-table-customer";
        $pagination['select'] = "username,id,status,detail";
        $pagination['component'] = "components.customer.table";
        $pagination['paginationView'] = "pagination-user";
        $pagination['join'] = "";

        if ($totalData > 10) {
            $paginations = view('vendor.pagination-test')->with($pagination)->render();
        } else {
            $paginations = array();
        }
    
        if (count($data) == 0) {
            $col['colspan'] = "4";
            $view = view('components.atom.table.empty')->with($col)->render();
        } else {
            $view = view('components.customer.table')->with($return)->render();
        }

        $attr['pagination'] = $paginations;
        $attr['table'] = $view;

        echo json_encode($attr);
    }

    public function changeStatus(Request $request) {
        $id = $request->id;
        $status = $request->status;

        $update = [
            'status' => $status,
            'updated_at' => Carbon::now(),
            'updated_by' => $request->session()->get('id')
        ];

        $save = User::find($id);
        $save->status = $status;
        $save->updated_at = Carbon::now();
        $save->updated_by = $request->session()->get("id");

        if ($save->save()) {
            $attr['status'] = "200";
            $attr['message'] = "Data successfully updated";
            $attr['data'] = array();
        } else {
            $attr['status'] = "500";
            $attr['message'] = "Something wrong";
            $attr['data'] = array();
        }

        echo json_encode($attr);
    }

    public function edit(Request $request) {
        $id = $request->id;

        $data = User::find($id);
        $detail = json_decode($data['detail'], TRUE);

        $send = [
            "username" => $data['username'],
            "email" => $detail['email'],
            "phone" => $detail['phone'],
            "address" => $detail['address'],
            "password" => $data['password'],
            "role" => $data['role']
        ];

        if (!empty($data)) {
            $attr['data'] = $send;
            $attr['status'] = "200";
            $attr['message'] = "Data found";
        } else {
            $attr['data'] = array();
            $attr['status'] = "500";
            $attr['message'] = "Data not found";
        }

        echo json_encode($attr);
    }
    
    public function postEdit(Request $request) {
        $all = $request->all();

        $validation = [
            "username" => "required|min_6",
            "email" => "required",
            "request" => $all
        ];
        
        $valid = $this->validation($validation);

        if (count($valid['error']) == 0) {
            // save 
            $detail = [
                'email' => $all['email'],
                'phone' => $all['phone'],
                'address' => $all['address'],
            ];

            $update = User::find($all['id']);
            $update->username = $all['username'];
            $update->role = $all['role'];
            $update->detail = json_encode($detail);

            if ($update->save()) {
                $attr['status'] = "200";
                $attr['message'] = "Data successfully updated";
                $attr['data'] = array();
            } else {
                $attr['status'] = "500";
                $attr['message'] = "Something wrong";
                $attr['data'] = $valid;
            }
        } else {
            $attr['status'] = "500";
            $attr['message'] = "Something wrong";
            $attr['data'] = $valid;
        }

        echo json_encode($attr);
    }

    public function delete(Request $request) {
        $id = $request->id;

        $save = User::find($id);
        $save->status = 0;
        $save->deleted_at = Carbon::now();

        if ($save->save()) {
            $attr['status'] = "200";
            $attr['message'] = "Data successfully delete";
            $attr['data'] = array();
        } else {
            $attr['status'] = "500";
            $attr['message'] = "Something wrong";
            $attr['data'] = array();
        }

        echo json_encode($attr);
    }
}
