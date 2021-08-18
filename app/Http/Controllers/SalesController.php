<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\SalesModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function addRow(Request $request) {
        $param = $request->param;
        $product = ProductModel::select(['id', 'product', 'price', 'stock'])->whereRaw('status = 1 AND stock > 100')->get();

        if (count($product) > 0) {
            $return['data'] = $product;
            $return['param'] = $param;
            $view = view('components.sales.form-tambah')->with($return)->render();
            $attr['data'] = $view;
            $attr['status'] = "200";
            $attr['message'] = "success";
        } else {
            $attr['data'] = array();
            $attr['status'] = "500";
            $attr['message'] = "Data not found";
        }

        echo json_encode($attr);
    }

    public function getProduct(Request $request) {
        $customer = User::select(['id', 'username'])->whereRaw('status = 1 AND role = 1')->get();
        $product = ProductModel::select(['id', 'product', 'price', 'stock'])->whereRaw('status = 1 AND stock > 100')->get();

        if (count($product) > 0) {
            $res['product'] = $product;
        } else {
            $res['product'] = array();
        }

        if ($request->session()->get('role') != 'admin') {
            $selfCustomer[] = [
                'id' => $request->session()->get('id'),
                'username' => $request->session()->get('username')
            ];

            $res['customer'] = $selfCustomer;
        } else {
            if (count($customer) > 0) {
                $res['customer'] = $customer;
            } else {
                $res['customer'] = array();
            }
        }

        $attr['data'] = $res;
        $attr['status'] = "200";
        $attr['message'] = "success";

        echo json_encode($attr);
    }

    public function post(Request $request) {
        $all = $request->all();
        $product = $all['product'];

        unset($all['product']);
        for ($i = 0; $i < count($product); $i++) {
            $split = explode('-', $product[$i]);
            $all['product'][] = $split[0];
            $name[] = $split[3];
        }

        for ($x = 0; $x < count($all['product']); $x++) {
            $detail[] = [
                'id' => $all['product'][$x],
                'qty' => $all['qty'][$x],
                'price' => $all['price'][$x],
                'total' => $all['price'][$x] * $all['qty'][$x] / 1000,
                'name' => $name[$x]
            ];
        }

        $save = new SalesModel();
        $save->date = Carbon::now();
        $save->customer_id = $all['name'];
        $save->detail = json_encode($detail);
        $save->product_id = json_encode($all['product']);
        $save->created_at = Carbon::now();
        $save->updated_at = Carbon::now();

        if ($save->save()) {

            // decrease stock
            for ($a = 0; $a < count($all['product']); $a++) {
                $stock = DB::table('product')->select('stock')->where("id", $all['product'][$a])->get();
                foreach ($stock as $st) {
                    $currentStock[] = $st->stock - $all['qty'][$a];
                }
            }

            for ($u = 0; $u < count($currentStock); $u++) {
                DB::table('product')->where('id', $all['product'][$u])->update([
                    'stock' => $currentStock[$u],
                    'updated_at' => Carbon::now()
                ]);
            }

            $attr['status'] = "200";
            $attr['data'] = array();
            $attr['message'] = "Sales order successfully save";
        } else {
            $attr['status'] = "500";
            $attr['data'] = array();
            $attr['message'] = "Something wrong";
        }

        echo json_encode($attr);
    }

    public function get(Request $request) {
        $page = $request->page;
        $perPage = 10;

        if ($page != 0) {
            $page = ($page - 1) * $perPage;
        }

        $totalData = DB::table('sales')
        ->select('id')
            ->whereRaw("date IS NOT NULL")
            ->count();

        $totalPage = ceil($totalData / $perPage);

        $sales = DB::table('sales')
            ->select(['sales.date', 'sales.product_id', 'sales.detail', 'sales.id', 'user.username'])
            ->join('user', 'user.id', '=', 'sales.customer_id')
            ->whereRaw("date IS NOT NULL")
            ->skip($page)
            ->take($perPage)
            ->get();

        if (count($sales) > 0) {
            foreach ($sales as $s) {
                $productId = json_decode($s->product_id, TRUE);
            }
    
            for ($a = 0; $a < count($productId); $a++) {
                $product = DB::table('product')->select('product')->whereRaw("status = 1 AND id = $productId[$a]")->get();
                foreach ($product as $p) {
                    $productName[] = $p->product;
                }
            }
    
            foreach ($sales as $sale) {
                $detail[] = json_decode($sale->detail, TRUE);
                $username[] = $sale->username;
            }
            
            for ($x = 0; $x < count($detail); $x++) {
                for ($b = 0; $b < count($detail[$x]); $b++) {
                    $newDetail[$x][$b] = $detail[$x][$b]['name'] . "(" . $detail[$x][$b]['qty'] . ")";
                    $price[$x][$b] = $detail[$x][$b]['total'];
                }
            }
    
            for ($n = 0; $n < count($newDetail); $n++) {
                $fixDetail[] = join(', ', $newDetail[$n]);
                $fixPrice[] = array_sum($price[$n]);
            }
    
            for($l = 0; $l < count($fixDetail); $l++) {
                $data[] = [
                    'username' => $username[$l],
                    'detail' => $fixDetail[$l],
                    'total' => $fixPrice[$l]
                ];
            }
        } else {
            $data = array();
        }

        $return['data'] = $data;
        $return['page'] = $page;

        $pagination['currentPage'] = $page + 1;
        $pagination['totalPage'] = $totalPage;
        $pagination['lastPage'] = $totalPage;
        $pagination['table'] = "sales";
        $pagination['condition'] = "date IS NOT NULL";
        $pagination['tableTarget'] = "target-table-sales";
        $pagination['select'] = "sales.date,sales.product_id,sales.detail,sales.id";
        $pagination['component'] = "components.sales.table";
        $pagination['paginationView'] = "pagination-sales";
        $pagination['join'] ="user,user.id,=,sales.customer_id";

        if ($totalData > 10) {
            $paginations = view('vendor.pagination-test')->with($pagination)->render();
        } else {
            $paginations = array();
        }

        if (count($data) == 0) {
            $col['colspan'] = "6";
            $view = view('components.atom.table.empty')->with($col)->render();
        } else {
            $view = view('components.sales.table')->with($return)->render();
        }

        $attr['pagination'] = $paginations;
        $attr['table'] = $view;

        echo json_encode($attr);
    }
}
