<?php
 
namespace App\View\Composers;

use App\Http\Services\CategoryService;
use App\Http\Services\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
 
class HeaderComposer
{
    public $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if(Auth::check()){
            $user=Auth::user();
            $user->cart=$user->cart()->count();
        }
        $data=$this->categoryService->getAll();
        $view->with(['user'=>$user??null,'category'=>$data]);
    }
}