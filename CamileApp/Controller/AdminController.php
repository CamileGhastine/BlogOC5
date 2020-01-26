<?php

namespace CamileApp\Controller;

use CamileApp\Core\App;

class AdminController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/admin/';
    protected $posts;
    protected $comment;
    protected $categories;

    public function __construct()
    {
        $this->posts = App::getinstance()->getManager('posts');
        $this->comments = App::getinstance()->getManager('comments');
        $this->categories = App::getinstance()->getManager('categories');
    }

    /**
     * Admin dashboard
     */
    public function home()
    {
        $this->render('home');
    }

    /**
     * Admin categories dashboard
     */
    public function posts()
    {
        $posts = $this->posts->allWithAllInfos();
        $this->render('posts', compact('posts'));
    }

    /**
     *
     */
    public function addPost()
    {
        if($_POST)
        {
            $this->categories->add();
            header('Location: index.php?route=admin.categories&success=add');
        }
        else
        {
            $this->render('addCategory');
        }

    }

    /**
     *
     */
    public function deletepost()
    {
        $this->categories->delete();
        header('Location: index.php?route=admin.categories&success=delete');
    }

    /**
     *
     */
    public function updatePost()
    {
        if($_POST)
        {
            $this->categories->update();
            header('Location: index.php?route=admin.categories&success=update');
        }
        else
        {
            $category = $this->categories->categoryById();
            $this->render('updateCategory', compact('category'));
        }
    }

    /**
     * Admin categories dashboard
     */
    public function categories()
    {
        $categories = $this->categories->all();
        $this->render('categories', compact('categories'));
    }

    /**
     *
     */
    public function addCategory()
    {
        if($_POST)
        {
            $this->categories->add();
            header('Location: index.php?route=admin.categories&success=add');
        }
        else
        {
            $this->render('addCategory');
        }

    }

    /**
     *
     */
    public function deleteCategory()
    {
        $this->categories->delete();
        header('Location: index.php?route=admin.categories&success=delete');
    }

    /**
     *
     */
    public function updateCategory()
    {
        if($_POST)
        {
            $this->categories->update();
            header('Location: index.php?route=admin.categories&success=update');
        }
        else
        {
            $category = $this->categories->categoryById();
            $this->render('updateCategory', compact('category'));
        }
    }
}