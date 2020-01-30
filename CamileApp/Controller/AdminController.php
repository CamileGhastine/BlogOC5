<?php

namespace CamileApp\Controller;

/**
 * Class AdminController functionalities accessible for administrator user
 * @package CamileApp\Controller
 */
class AdminController extends Controller
{
    protected $viewPath = ROOT . '/CamileApp/view/admin/';

    /**
     * check if the user is admin
     */
    public function isAdmin()
    {
        if($_SESSION['statut'] !== 'admin')
        {
            header('Location: index.php?route=back.connectionRegister&access=adminDenied');
            exit;
        }
    }

    /**
     * Admin dashboard
     */
    public function home()
    {
        $this->isAdmin();

        $this->render('home');
    }

    /**
     * Admin posts dashboard
     */
    public function posts()
    {
        $this->isAdmin();

        $posts = $this->posts->allWithAllInfos();
        $this->render('posts', compact('posts'));
    }

    /**
     * add post in admin dashboard
     */
    public function addPost()
    {
        $this->isAdmin();

        if($_POST)
        {
            $formMessage = $this->postsValidationForm->checkForm($_POST);

            if(!$formMessage)
            {
                $this->posts->add();
                header('Location: index.php?route=admin.posts&success=add');
                exit;
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
     * delete post in admin dashboard
     */
    public function deletepost()
    {
        $this->isAdmin();

        $this->posts->delete();
        header('Location: index.php?route=admin.posts&success=delete');
        exit;
    }

    /**
     * update post in admin dashboard
     */
    public function updatePost()
    {
        $this->isAdmin();

        if($_POST)
        {
            $formMessage = $this->postsValidationForm->checkForm($_POST);

            if(!$formMessage)
            {
                $this->posts->update();
                header('Location: index.php?route=admin.posts&success=update');
                exit;
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
        $this->isAdmin();

        $categories = $this->categories->allWithPostCount();
        $this->render('categories', compact('categories'));
    }

    /**
     * add category in admin dashboard
     */
    public function addCategory()
    {
        $this->isAdmin();

        if($_POST)
        {
            $formMessage = $this->categoriesValidationForm->checkForm($_POST);

            if(!$formMessage)
            {
                $this->categories->add();
                header('Location: index.php?route=admin.categories&success=add');
                exit;
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
     * delete category in admin dashboard
     */
    public function deleteCategory()
    {
        $this->isAdmin();

        if($_GET['id'] != 1)
        {
            $this->posts->changeCategoryToUnknown();
            $this->categories->delete();
            header('Location: index.php?route=admin.categories&success=delete');
            exit;
        }
        else
        {
            header('Location: index.php?route=admin.categories&success=no');
            exit;
        }
    }

    /**
     *update category in admin dashboard
     */
    public function updateCategory()
    {
        $this->isAdmin();


        if($_POST)
        {
            $formMessage = $this->categoriesValidationForm->checkForm($_POST);

            if(!$formMessage)
            {
                $this->categories->update();
                header('Location: index.php?route=admin.categories&success=update');
                exit;
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