<?php

namespace Database\Seeders;

use App\Models\ProductModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                "product" => "beras",
                "price" => "23000",
                "stock" => "2300",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "Kangkung",
                "price" => "2000",
                "stock" => "500",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "cabai rawit merah",
                "price" => "75000",
                "stock" => "3400",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "cabe merah besar",
                "price" => "17000",
                "stock" => "230",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "terasi",
                "price" => "1200",
                "stock" => "1000",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "kunyit",
                "price" => "10000",
                "stock" => "3255",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "jahe merah",
                "price" => "33000",
                "stock" => "2200",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "pekak",
                "price" => "19000",
                "stock" => "2000",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "serai",
                "price" => "5000",
                "stock" => "1000",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "tomat daging",
                "price" => "44000",
                "stock" => "3300",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "tomat masak",
                "price" => "2000",
                "stock" => "1200",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
            [
                "product" => "jeruk limau",
                "price" => "33000",
                "stock" => "35000",
                "created_at" => Carbon::now(),
                "created_by" => "1",
                "updated_at" => Carbon::now(),
                "updated_by" => "1"
            ],
        ];
        ProductModel::insert($product);
    }
}
