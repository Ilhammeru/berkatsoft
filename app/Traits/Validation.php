<?php 

namespace App\Traits;

trait validation {
    public function validation($param) {
        $request = $param['request'];
        unset($param['request']);

        unset($request['_token']);

        $data = array();
        $regKey = array();
        $z = 0;
        foreach ($param as $key => $value) {
            // get registerd key
            $regKey[$key][] = $param[$key];
            $exp = explode("|", $value);

            foreach ($exp as $e) {
                $exp1 = explode("_", $e);

                if (count($exp1) > 1) {
                    if ($exp1[0] == "min") {
                        if (strlen($request[$key]) < $exp1[1]) {
                            $data[$key][] = $key . " must be more than " . $exp1[1] . " character";
                        } else {
                            $data[$key][] = "";
                        }
                    }
                } else {
                    if ($e == "required") {
                        if ($request[$key] == "") {
                            $data[$key][] = "value required";
                        } else {
                            $data[$key][] = "";
                        }
                    } else if ($e == 'array') {
                        if (is_array($request[$key])) {
                            $data[$key][] = "";
                        } else {
                            $data[$key][] = "array required";
                        }
                    } else if ($e == "alphaNum") {
                        if (preg_match('~[0-9]+~', $request[$key])) {
                            $data[$key][] = "";
                        } else {
                            $data[$key][] = $key . " must contains numeric and alphabet";
                        }
                    }
                }

                // filter 
                $filter[$key] = array_values(array_filter($data[$key]));
            }

            $z++;
        }

        $error = $this->compact($filter, $regKey);
        $attr['error'] = $error;

        return $attr;
        
    }

    public function compact($param, $request) {
        $error = array();
        foreach ($request as $key => $value) {
            if (in_array('value required', $param[$key])) {
                $error[$key][] = $key . " must have value";
            } else {
                if (count($param[$key]) > 0) {
                    $error[$key] = $param[$key];
                }
            }
        }

        return $error;
    }
}

?>