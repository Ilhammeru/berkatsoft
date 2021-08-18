<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\Validation;
use Carbon\Carbon;

class ProductController extends Controller
{
    use validation;

    public function get(Request $request) {
        $page = $request->page;
        $perPage = 10;

        if ($page != 0) {
            $page = ($page - 1) * $perPage;
        }

        $totalData = DB::table('product')
            ->select('id')
            ->whereRaw("status > 0")
            ->count();

        $totalPage = ceil($totalData / $perPage);

        $data = DB::table('product')
            ->select(['product', 'id', 'status', 'price', 'stock'])
            ->whereRaw("status > 0")
            ->skip($page)
            ->take($perPage)
            ->get();

        $return['data'] = $data;
        $return['page'] = $page;

        $pagination['currentPage'] = $page + 1;
        $pagination['totalPage'] = $totalPage;
        $pagination['lastPage'] = $totalPage;
        $pagination['table'] = "product";
        $pagination['condition'] = "status > 0";
        $pagination['tableTarget'] = "target-table-product";
        $pagination['select'] = "product,id,status,price,stock";
        $pagination['component'] = "components.product.table";
        $pagination['paginationView'] = "pagination-product";
        $pagination['join'] = "";

        if ($totalData > 10) {
            $paginations = view('vendor.pagination-test')->with($pagination)->render();
        } else {
            $paginations = array();
        }

        if (count($data) == 0) {
            $col['colspan'] = "6";
            $view = view('components.atom.table.empty')->with($col)->render();
        } else {
            $view = view('components.product.table')->with($return)->render();
        }

        $attr['pagination'] = $paginations;
        $attr['table'] = $view;

        echo json_encode($attr);
    }

    public function post(Request $request) {
        $all = $request->all();

        $validation = [
            'product' => "required",
            'price' => "required",
            'request' => $all
        ];

        $valid = $this->validation($validation);

        if (count($valid['error']) == 0) {
            //save 
            $check = ProductModel::select(['id', 'product', 'status', 'price', 'stock'])->where("product", $all['product'])->first();

            if (empty($check)) {
                $save = new ProductModel();

                $save->product = $all['product'];
                $save->price = $all['price'];
                $save->stock = $all['stock'];
                $save->created_at = Carbon::now();
                $save->created_by = $request->session()->get('id');
                $save->updated_at = Carbon::now();
                $save->updated_by = $request->session()->get('id');

                if ($save->save()) {
                    $attr['status'] = "200";
                    $attr['message'] = "Product successfully save";
                    $attr['data'] = array();
                } else {
                    $attr['status'] = "500";
                    $attr['message'] ="Somethinig wrong";
                    $attr['data'] = array();
                }
            } else {
                $err = [
                    'error' => [
                        'product' => ["This product is already saved"]
                    ]
                ];
                $attr['status'] = "500";
                $attr['message'] = "Something wrong";
                $attr['data'] = $err; 
            }
        } else {
            $attr['status'] = "500";
            $attr['message'] = "Something wrong";
            $attr['data'] = $valid;
        }

        echo json_encode($attr);
    }

    public function postProduct(Request $request)
    {
        $all = $request->all();

        $validation = [
            'product' => "required",
            'price' => "required",
            'request' => $all
        ];

        $valid = $this->validation($validation);

        if (count($valid['error']) == 0) {
            //save 
            $check = ProductModel::select(['id', 'product', 'status', 'price', 'stock'])->where("product", $all['product'])->first();

            if (empty($check)) {
                if ($all['id'] != "") {
                    $affect = DB::table('product')->where('id', $all['id'])->update([
                        'product' => $all['product'],
                        'price' => $all['price'],
                        'stock' => $all['stock'],
                        'updated_at' => Carbon::now(),
                        'updated_by' => $request->session()->get('id')
                    ]);

                    if ($affect) {
                        $attr['status'] = "200";
                        $attr['message'] = "Product successfully save";
                        $attr['data'] = array();
                    } else {
                        $attr['status'] = "500";
                        $attr['message'] = "Somethinig wrong";
                        $attr['data'] = array();
                    }
                } else {
                    $save = new ProductModel();
    
                    $save->product = $all['product'];
                    $save->price = $all['price'];
                    $save->stock = $all['stock'];
                    $save->created_at = Carbon::now();
                    $save->created_by = $request->session()->get('id');
                    $save->updated_at = Carbon::now();
                    $save->updated_by = $request->session()->get('id');
    
                    if ($save->save()) {
                        $attr['status'] = "200";
                        $attr['message'] = "Product successfully save";
                        $attr['data'] = array();
                    } else {
                        $attr['status'] = "500";
                        $attr['message'] = "Somethinig wrong";
                        $attr['data'] = array();
                    }
                }
            } else {
                if ($all['helper_product'] == $all['product']) {
                    $affect = DB::table('product')->where('id', $all['id'])->update([
                        'product' => $all['product'],
                        'price' => $all['price'],
                        'stock' => $all['stock'],
                        'updated_at' => Carbon::now(),
                        'updated_by' => $request->session()->get('id')
                    ]);

                    if ($affect) {
                        $attr['status'] = "200";
                        $attr['message'] = "Product successfully save";
                        $attr['data'] = array();
                    } else {
                        $attr['status'] = "500";
                        $attr['message'] = "Somethinig wrong";
                        $attr['data'] = array();
                    }
                } else {
                    $err = [
                        'error' => [
                            'product' => ["This product is already saved"]
                        ]
                    ];
                    $attr['status'] = "500";
                    $attr['message'] = "Something wrong";
                    $attr['data'] = $err;
                }
            }
        } else {
            $attr['status'] = "500";
            $attr['message'] = "Something wrong";
            $attr['data'] = $valid;
        }

        echo json_encode($attr);
    }

    public function change(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $check = DB::table("sales")->select('id')->whereRaw("JSON_CONTAINS(product_id, JSON_QUOTE('$id'), '$') = 1")->count();

        if ($check == 0) {
            $save = ProductModel::find($id);
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
        } else {
            $attr['status'] = "500";
            $attr['message'] = "This item is have relation with sales";
            $attr['data'] = array();
        }


        echo json_encode($attr);
    }

    public function edit(Request $request) {
        $id = $request->id;

        $check = DB::table('sales')
                    ->select('id')
                    ->where('product_id', $id)
                    ->count();

        $data = ProductModel::find($id);
        $send = [
            "product" => $data['product'],
            "price" => $data['price'],
            "stock" => $data['stock']
        ];

        if ($check == 0) {
            $send = [
                "product" => $data['product'],
                "price" => $data['price'],
                "stock" => $data['stock'],
                "status" => "ok"
            ];
        } else {
            $send = [
                "product" => $data['product'],
                "price" => $data['price'],
                "stock" => $data['stock'],
                "status" => "no"
            ];
        }

        $attr['data'] = $send;
        echo json_encode($attr);
    }

    public function delete(Request $request) {
        $id = $request->id;

        $check = DB::table('sales')->select('id')->whereRaw("JSON_CONTAINS(product_id, JSON_QUOTE('$id'), '$') = 1")->count();

        if ($check > 0) {
            $attr['status'] = "500";
            $attr['message'] = "This data is already exist on sales";
            $attr['data'] = array();
        } else {
            $affect = ProductModel::where('id', $id)->update([
                'status' => "0",
                'deleted_at' => Carbon::now()
            ]);

            if ($affect) {
                $attr['status'] = "200";
                $attr['message'] = "Item successfully deleted";
                $attr['data'] = array();
            } else {
                $attr['status'] = "500";
                $attr['message'] = "Something wrong";
                $attr['data'] = array();
            }
        }

        echo json_encode($attr);
    }
}
