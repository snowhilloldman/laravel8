<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
  /**
   * Title for current resource.
   *
   * @var string
   */
  protected $title = 'Category';

  /**
   * Make a grid builder.
   *
   * @return Grid
   */
  protected function grid()
  {
    $grid = new Grid(new Category());
    $grid->model()->orderByDesc('rank');

    $grid->column('id', __('Id'));
    $grid->column('title', __('Name'));
    $grid->column('icon', __('Icon'));
    $grid->column('father_id', __('Category Id'));
    $grid->column('user_id', __('User Id'));
    $grid->column('rank', __('Rank'));
    $grid->column('description', __('Description'));
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
    $show = new Show(Category::findOrFail($id));


    $show->field('id', __('Id'));
    $show->field('title', __('Name'));
    $show->field('icon', __('Email'));
    $show->field('father_id', __('Category Id'));
    $show->field('user_id', __('User Id'));
    $show->field('amount', __('amount'));
    $show->field('description', __('Description'));
    $show->field('status', __('Status'));
    $show->field('created_at', __('Created at'));
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
    $categoryTree = $category->getTree('root');

    $form = new Form(new Category());


    $form->text('title', __('Name'))->required();

    $form->icon('icon', __('Icon'));
    $form->select('father_id', __('Category Id'))->options($categoryTree)->default(0);

    $form->number('rank', __('Rank'));
    // $form->text('user_id', __('User Id'))->default($userId)->disable();
    // $form->ckeditor('description', __('Description'));
    $form->textarea('description', __('Description'));
    // $form->text('status', __('Status'));
    $form->radio('status', __('Status'))->options(['draft' => 'Darft', 'closed' => 'Closed', 'public' => 'public'])->default('draft');
    $form->hidden('user_id')->default($userId);
    // $categories = DB::select('select * from categories where father_id=0');
    // $categories = DB::table('categories')->where('father_id', 1)->get();
    // var_dump($categories);
    // exit;
    return $form;
  }


}