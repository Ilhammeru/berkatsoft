<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function tableLoader(Request $request)
    {
        $param = $request->param;

        $send['colspan'] = $param;

        $attr['page'] = view('components.atom.table.loading')->with($send)->render();

        echo json_encode($attr);
    }

    public function tableEmpty(Request $request)
    {
        $param = $request->param;

        $send['colspan'] = $param;

        $attr['page'] = view('components.atom.table.empty')->with($send)->render();

        echo json_encode($attr);
    }

    public function dataPagination(Request $request)
    {
        $table = $request->table;
        $page = $request->page;
        $select = $request->select;
        $tableTarget = $request->target;
        $component = $request->component;
        $view = $request->paginationView;
        $join = $request->join;

        $expSelect = explode(",", $select);

        if ($join != "") {
            $expJoin = explode(',', $join);
        }

        $condition = $request->condition;
        $perPage = 10;

        if ($page != 0) {
            $page = ($page - 1) * $perPage;
            $activePage = $request->page;
        } else {
            $activePage = $page + 1;
        }

        if ($join != "") {
            $sales = DB::table($table)->select($expSelect)->join("'$expJoin[0]'", "'$expJoin[1]'", "'$expJoin[2]'", "'$expJoin[3]'")->whereRaw($condition)->skip($page)->take($perPage)->get();

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

            for ($l = 0; $l < count($fixDetail); $l++) {
                $data[] = [
                    'username' => $username[$l],
                    'detail' => $fixDetail[$l],
                    'total' => $fixPrice[$l]
                ];
            }
        } else {
            $data = DB::table($table)->select($expSelect)->whereRaw($condition)->skip($page)->take($perPage)->get();
        }

        $totalData = DB::table($table)->select($expSelect)->whereRaw($condition)->count();
        $totalPage = ceil($totalData / $perPage);

        $pagination['currentPage'] = $activePage;
        $pagination['totalPage'] = $totalPage;
        $pagination['lastPage'] = $totalPage;
        $pagination['table'] = $table;
        $pagination['condition'] = $condition;
        $pagination['tableTarget'] = $tableTarget;
        $pagination['select'] = $select;
        $pagination['component'] = $component;
        $pagination['paginationView'] = $view;
        $pagination['join'] = $join;

        $return['data'] = $data;
        $return['page'] = $page;

        $attr['pagination'] = view('vendor.pagination-test')->with($pagination)->render();
        $attr['data'] = view($component)->with($return)->render();
        $attr['join'] = $data;
        echo json_encode($attr);
    }
}
