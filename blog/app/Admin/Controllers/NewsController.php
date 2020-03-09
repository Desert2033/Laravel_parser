<?php

namespace App\Admin\Controllers;

use App\News;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;
use App\Admin\Extensions\PHPEditor;
use App\classes\ToString2;

class NewsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\News';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new News());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('date', __('Date'));
        $grid->column('authors', __('Authors'));
        $grid->column('text', __('Text'));
        $grid->column( 'image', __('Image'))->display(function ($image){
            if (!isset($image))
                return null;

            return  '<img src="data:image/jpeg;base64, '.$image.'" class="img-responsive">';
        });
        $grid->column('id_user', __('Id user'));
        $grid->column('created_at', __('Created at'));
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
        $a = ['RRRRRRRRRRRRRRRRRRRRRRRRRRrr'];
        $html = new Form\Field\Html('<p>huhiuhuihu</p>', $a);
        $show = new Show(News::findOrFail($id));
        $content = new Content();
        $html->column();
        $image = "https://www.google.com/search?q=rfhnbyrb&safe=active&sxsrf=ALeKk03lTGI49mlzMij5bn9io3JTNotFmA:1583507316158&tbm=isch&source=iu&ictx=1&fir=HFNJQtCtjzILjM%253A%252CN02-67896LnfIM%252C_&vet=1&usg=AI4_-kQJoaK-ossUqHfUm0xvkxG_Slnw6Q&sa=X&ved=2ahUKEwikrNC4kIboAhWFvosKHZxiBCMQ9QEwAHoECAoQHA#imgrc=HFNJQtCtjzILjM:";
        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('date', __('Date'));
        $show->field('authors', __('Authors'));
        $show->field('text', __('Text'));
        $show->field('id_user', __('Id user'));
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
        $form = new Form(new News());
        $string = new ToString2();
     //   $form->text('title', __('Title'));
        $form->text('date', __('Date'));
        $form->text('authors', __('Authors'));
        $form->textarea('text', __('Text'));
        $form->myImage('image');
        $form->number('id_user', __('Id user'));
        $form->html($string, __('Title'));
        $form->saving(function ($form){

            if ($form->input('image') != null)
            {
                $image = file_get_contents($form->input('image'));
                $image = base64_encode($image);
                $image = addslashes($image);
                $form->image = $image;
            }

        });

        return $form;
    }
}
