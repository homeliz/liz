<?php

namespace App\Http\Controllers\Admin\Common;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function download( Request $request )
    {
        #选项
        $option = $request->input('option');

        if ( !in_array( $option, array('1') ) ) {
            die('参数错误');
        }

        #下载评论模板
        if( $option == 1 ) {
            $name = 'comment_template_'. date('Y_m_d') . '.xls';
            return response()->download(realpath(base_path('public')).'/uploads/file/qyds_comment_template.xls', $name);
        }

    }
}
