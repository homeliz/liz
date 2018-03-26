<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis as Redis;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends BasicController
{
    // 加载超级管理员主页
    public function main( Request $request )
    {
        $user_name = Redis::get('MF_ADMIN_USER_ID' . session()->getId());   // 获取当前用户名
        $menu_key = $request->input('menu');
        $permissions=session('permissions');

        if (empty($menu_key)) {
            $menu_key = 0;
        }

       
        if($permissions==2){
             #顶部菜单
            $menu = [
                0 => '路由器',
                2 => '日志',
            ];

            #左侧栏菜单
            $left_menus = [];

            if ( $menu_key == 0 ) {  #路由器
                $left_menus = [
                    [
                        'icon' => '/images/admin/lyq.png',
                        'name' => '路由器管理',
                        'sub' => [
                            0 => [
                                'name' => '路由器管理',
                                'link' => '/mf/router/index',
                            ]
                        ]
                    ],

                ];
            } elseif ( $menu_key == 2 ) {   #财务

                $left_menus = [
                    [
                        'icon' => '/images/admin/pl-1.png',
                        'name' => '接口日志',
                        'sub' => [
                            0 => [
                                'name' => '接口日志',
                                'link' => '/mf/interface/index',
                            ]
                        ]
                    ],

                ];

            } elseif ( $menu_key == 3 ) {   #系统

                $left_menus = [
                    [
                        'icon' => '/images/admin/cwgl.png',
                        'name' => '账号列表',
                        'sub' => [
                            0 => [
                                'name' => '账号列表',
                                'link' => '/cc-admin/index',
                            ]
                        ]
                    ],
                    /*               [
                                       'icon' => '/images/admin/yonghu.png',
                                       'name' => '用户中中',
                                       'sub' => [
                                           0 => [
                                               'name' => 'dducm',
                                               'link' => '/cc-admin/index',
                                           ]
                                       ]
                                   ],*/

                ];

            }
        }else{
             $menu = [
                0 => '路由器',
                1 => '服务器',
                2 => '日志',
            ];

            #左侧栏菜单
            $left_menus = [];
            if ( $menu_key == 0 ) {  #路由器
                $left_menus = [
                    [
                        'icon' => '/images/admin/lyq.png',
                        'name' => '路由器管理',
                        'sub' => [
                            0 => [
                                'name' => '路由器管理',
                                'link' => '/mf/router/index',
                            ]
                        ]
                    ],
                      [
                        'icon' => '/images/admin/userIcon.png',
                        'name' => '用户管理',
                        'sub' => [
                            0 => [
                                'name' => '用户管理',
                                'link' => '/mf/user/index',
                            ]
                        ]
                    ],

                ];
            } elseif ( $menu_key == 1 ) {  #服务器

                $left_menus = [
                    [
                        'icon' => '/images/admin/fwq.png',
                        'name' => '服务器',
                        'sub' => [
                            0 => [
                                'name' => 'SSR服务器',
                                'link' => '/mf/server/index',
                            ]
                        ]
                    ],
                ];

            } elseif ( $menu_key == 2 ) {   #财务

                $left_menus = [
                    [
                        'icon' => '/images/admin/pl-1.png',
                        'name' => '接口日志',
                        'sub' => [
                            0 => [
                                'name' => '接口日志',
                                'link' => '/mf/interface/index',
                            ]
                        ]
                    ],
                    /*               [
                                       'icon' => '/images/admin/yonghu.png',
                                       'name' => '用户中中',
                                       'sub' => [
                                           0 => [
                                               'name' => 'dducm',
                                               'link' => '/cc-admin/index',
                                           ]
                                       ]
                                   ],*/

                ];

            } elseif ( $menu_key == 3 ) {   #系统

                $left_menus = [
                    [
                        'icon' => '/images/admin/cwgl.png',
                        'name' => '账号列表',
                        'sub' => [
                            0 => [
                                'name' => '账号列表',
                                'link' => '/cc-admin/index',
                            ]
                        ]
                    ],
                    /*               [
                                       'icon' => '/images/admin/yonghu.png',
                                       'name' => '用户中中',
                                       'sub' => [
                                           0 => [
                                               'name' => 'dducm',
                                               'link' => '/cc-admin/index',
                                           ]
                                       ]
                                   ],*/

                ];

            }
        }


        if (!isset($menu[$menu_key])) {
            foreach ($menu as $key => $value) {
                $menu_key = $key;
                break;
            }
        }

        $data = [
            'menus' => $menu,
            'menu_key' => $menu_key,
            'left_menus' => $left_menus,
            'user_name' => $user_name

        ];

        return view('admin/main', $data);

    }



}
