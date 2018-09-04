<?php

namespace App\Http\Controllers; //命名空间在PHP5.3之后的语言特性；利用命名空间区分归类不同的代码功能，避免引起变量名或函数名的冲突 可以理解为文件路径。变量名理解为文件。

use Illuminate\Http\Request; //use引用类 引用后可调用
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Status;
use Auth;

class StaticPagesController extends Controller //可以引用除private方法以外的其他方法
{
    public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(10);
        }
        return view('static_pages/home', compact('feed_items'));
    }

    public function help()
    {
        return view('static_pages/help');
    }

    public function about()
    {
        return view('static_pages/about');
    }
}
