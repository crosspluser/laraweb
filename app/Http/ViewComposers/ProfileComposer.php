<?php
/**
 * Created by PhpStorm.
 * User: hali
 * Date: 2017/12/22
 * Time: 09:47
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;//应该用View基础类,不用门面
use App\User;//use App\Repositories\UserRepository;文档里给的Repository是后期用到的基于model的新层,自定义的服务,初始不带;估计文档编写者自己环境里有,但没有在初始环境测试过

class ProfileComposer{

    protected $users;

    public function __construct( User $users ){
        $this->users = $users;
    }

    public function compose( View $view ){
        $view->with( 'count', $this->users->count() );
    }

}