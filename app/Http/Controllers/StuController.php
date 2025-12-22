<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StuController extends Controller
{
    //
    public function getStuLists() {
        $stuList = [
            ['age'=>12,'name'=>"张三"],
            ['age'=>13,'name'=>"张三"],
        ];
        $answer = config('logging.deprecations.channel');
        // dd(config('logging.deprecations.channel','no config'));
        echo "deprecations log channel is : ".$answer;
        return $stuList;
    }
}
