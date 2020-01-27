<?php

namespace CamileApp\Controller;

class AdminController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/admin/';

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
            $formMessage = $this->postsValidationForm->checkValidity($_POST);

            if(!$formMessage)
            {
                $this->posts->add();
                header('Location: index.php?route=admin.posts&success=add');
            }
            else
            {
                $postAddUnvalid = $_POST;
                $categories = $this->categories->all();
                $this->render('addOrUpdatePost', compact('categories', 'formMessage', 'postAddUnvalid'));
            }
        }
        else
        {
            $categories = $this->categories->all();
            $this->render('addOrUpdatePost', compact('categories'));
        }

    }

    /**
     *
     */
    public function deletepost()
    {
        $this->posts->delete();
        header('Location: index.php?route=admin.posts&success=delete');
    }

    /**
     *
     */
    public function updatePost()
    {
        if($_POST)
        {
            $formMessage = $this->postsValidationForm->checkValidity($_POST);

            if(!$formMessage)
            {
                $this->posts->update();
                header('Location: index.php?route=admin.posts&success=update');
            }
            else
            {
                $id = $_GET['id'];
                $postUpdateUnvalid = $_POST;
                $categories = $this->categories->all();
                $this->render('addOrUpdatePost', compact('categories', 'formMessage', 'postUpdateUnvalid', 'id'));
            }
        }
        else
        {
            $post = $this->posts->postById($_GET['id']);
            $categories = $this->categories->all();
            $this->render('addOrUpdatePost', compact('post', 'categories'));
        }
    }

    /**
     * Admin categories dashboard
     */
    public function categories()
    {
        $categories = $this->categories->allWithPostCount();
        $this->render('categories', compact('categories'));
    }

    /**
     *
     */
    public function addCategory()
    {
        if($_POST)
        {
            $formMessage = $this->categoriesValidationForm->checkValidity($_POST);

            if(!$formMessage)
            {
                $this->categories->add();
                header('Location: index.php?route=admin.categories&success=add');
            }
            else
            {
                $postAddUnvalid = $_POST;
                $this->render('addOrUpdatecategory', compact('formMessage', 'postAddUnvalid'));
            }
        }
        else
        {
            $this->render('addOrUpdateCategory');
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
        $formMessage = $this->categoriesValidationForm->checkValidity($_POST);

        if($_POST)
        {
            if(!$formMessage)
            {
                $this->categories->update();
                header('Location: index.php?route=admin.categories&success=update');
            }
            else
            {
                $id = $_GET['id'];
                $postUpdateUnvalid = $_POST;
                $this->render('addOrUpdateCategory', compact('formMessage', 'postUpdateUnvalid', 'id'));
            }
        }
        else
        {
            $category = $this->categories->categoryById();
            $this->render('addOrUpdateCategory', compact('category'));
        }
    }
}