<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\City;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrgController extends AdminController
{
  /**
   * Title for current resource.
   *
   * @var string
   */
  protected $title = 'ORG-TK机构/卖家/服务商/MCN等';
  protected $type = 'org';

  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function grid()
  {

    $grid = new Grid(new Post());
    $grid->model()->where('post_type', '=', 'org');

    $grid->column('id', __('Id'));
    $grid->column('title', __('Title'));
    $grid->column('icon', __('Icon'));
    // $grid->column('category_id', __('Category Id'));
    $grid->category_id()->display(function ($category_id) {
      $c = Category::find($category_id);
      return $c ? $c->title : '';
    });


    $grid->province()->display(function ($province) {
      $p = City::find($province);
      return $p ? $p->name : '';
    });
    // $grid->column('city', __('City'));
    $grid->city()->display(function ($city) {
      $p = City::find($city);
      return $p ? $p->name : '';
    });
    $grid->column('org_role', __('Company Role'));
    $grid->column('status', __('Status'));
    $grid->column('created_at', __('Created at'))->hide();
    $grid->column('updated_at', __('Updated at'));

    return $grid;
  }

  /**
   * Make a show builder.
   *
   * @param mixed $id
   * @return Show
   */
  protected function detail($id)
  {
    $show = new Show(Post::findOrFail($id));


    $show->field('id', __('Id'));
    $show->field('title', __('Title'));
    $show->field('icon', __('Icon'));
    $show->field('category_id', __('Category Id'));
    $show->field('user_id', __('User Id'));
    $show->field('content', __('Content'));
    $show->field('status', __('Status'));
    $show->field('province', __('Province'));
    $show->field('city', __('city'));
    $show->field('org_role', __('Company Role'));
    $show->field('created_at', __('Created at'))->hide();
    $show->field('updated_at', __('Updated at'));



    return $show;
  }

  /**
   * Make a form builder.
   *
   * @return Form
   */
  protected function form()
  {
    $userId = Auth::user()->id;
    $category = new Category();
    $categoryTree = $category->getTree();


    $form = new Form(new Post());


    // $form->setWidth(100);
    $form->text('title', __('Name'))->required();

    $form->icon('icon', __('Icon'));
    $form->image('logo', 'logo')->removable();
    $form->select('category_id', __('Category Id'))->options($categoryTree)->default(0)->required();

    $form->select('province', 'Province')->options(City::deep0Options())->load('city', '/api/city');

    $form->select('city', "城市")->options(City::deep1Options());
    $form->text('address', '地址');

    $form->text('telephone', '电话');
    $form->text('website', '网址');
    $form->image('wechat', '联系人微信');
    $form->image('wechat_gz', '公众号');
    $form->text('telephone', '电话');
    $form->editor('content', __('Content'));

    $form->text('brief', '简要');

    $form->radio('status', __('Status'))->options(Post::$statusOptions)->default('draft');
    $form->hidden('user_id')->default($userId);
    $form->hidden('post_type')->default($this->type);

    return $form;
  }


}