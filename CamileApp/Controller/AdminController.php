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
                $_POST['user_id'] = $_SESSION['id'];
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

        $this->comments->deleteAllByPostId($_GET['id']);
        $this->posts->delete($_GET['id']);
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
                $_POST['id'] = $_GET['id'];
                $this->posts->update();
                header('Location: index.php?route=admin.posts&success=update');
                exit;
            }
            else
            {
                $id = $_GET['id'];
                $postUpdateUnvalid = $_POST;
                $comments = $this->comments->commentsById($_GET['id']);
                $categories = $this->categories->all();
                $this->render('addOrUpdatePost', compact('categories', 'comments', 'formMessage', 'postUpdateUnvalid', 'id'));
            }
        }
        else
        {
            $post = $this->posts->postById($_GET['id']);
            $comments = $this->comments->commentsById($_GET['id']);
            $categories = $this->categories->all();
            $this->render('addOrUpdatePost', compact('post', 'categories', 'comments'));
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
            $this->categories->delete($_GET['id']);
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
                $_POST['id'] = $_GET['id'];
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

    /**
     * display the comments and modification functionality
     */
    public function comments()
    {
        $this->isAdmin();

        $post = $this->posts->postById($_GET['id']);
        $comments = $this->comments->commentsById($_GET['id']);
        $this->render('comments', compact('post', 'comments'));
    }

    /**
     * Validate a comment
     */
    public function validateComment()
    {
        $this->isAdmin();

        $this->comments->validate($_GET['commentId']);
        header('Location: index.php?route=admin.comments&id=' . $_GET['id'] . '&action=validate#comments');
        exit;
    }

    /**
     * delete a comment
     */
    public function deleteComment()
    {
        $this->isAdmin();

        $this->comments->delete($_GET['commentId']);
        header('Location: index.php?route=admin.comments&id=' . $_GET['id'] . '&action=delete#comments');
        exit;
    }

    /**
     * modify comment
     */
    public function updateComment()
    {
        $this->isAdmin();

        $this->comments->update($_GET['commentId'], $_POST['content']);
        header('Location: index.php?route=admin.comments&id=' . $_GET['id'] . '&action=update#comments');
        exit;
    }

    /**
     * Admin users dashboard
     */
    public function users()
    {
        $this->isAdmin();

        $numberUsersUnvalidated = $this->users->countUnvalidated();
        $users = $this->users->getValidated('pseudo');
        $this->render('users', compact('users', 'numberUsersUnvalidated'));
    }

    /**
     * add user
     */
    public function addUser()
    {
        $this->isAdmin();

        if($_POST)
        {
            $post = $_POST;

            // Form verification
            $formMessage = $this->pseudoOrEmailExist() ? $this->pseudoOrEmailExist() : $formMessage = $this->usersValidationForm->checkForm($_POST);

            if($formMessage)  // form ok
            {
                $statuts = $this->users->statut();
                $this->render('addOrUpdateUser', compact('statuts', 'formMessage', 'post'));
            }
            else // form not ok
            {
                $_POST['validated'] = 1;
                $this->users->add($_POST);
                header('Location: index.php?route=admin.users&success=add');
                exit;
            }
        }
        else
        {
            $statuts = $this->users->statut();
            $this->render('addOrUpdateUser', compact('statuts'));
        }
    }

    /**
     * Modify user
     */
    public function updateUser()
    {
        $this->isAdmin();

        $update = true;
        if($_POST == null)
        {
            $user = $this->users->infoPseudoWithId($_GET['id']);
            $statuts = $this->users->statut();
            $this->render('addOrUpdateUser', compact('user', 'update', 'statuts'));
        }
        else
        {
            $postUpdate = $_POST;
            $postUpdate['id'] = $_GET['id'];

            // Form verification
            $formMessage = $this->pseudoOrEmailExist($_GET['id']) ? $this->pseudoOrEmailExist($_GET['id']) : $this->usersValidationForm->checkForm($_POST);

            if($formMessage)  // form not ok
            {
                $statuts = $this->users->statut();
                $this->render('addOrUpdateUser', compact('statuts', 'formMessage', 'postUpdate', 'update'));
            }
            else // form ok
            {
                $this->users->update(['id' => $_GET['id'], 'pseudo' => $_POST['pseudo'], 'email' => $_POST['email'], 'statut' => $_POST['statut']];);
                header('Location: index.php?route=admin.users&success=update');
                exit;
            }
        }
    }

    /**
     * validate user
     */
    public function validateUsers()
    {
        $this->isAdmin();

        if($_POST == null)
        {
            $users = $this->users->getUnvalidated();
            $this->render('validate', compact('users'));
        }
        else
        {
            $this->users->validate(['id' => $_GET['id']]);
            header('Location: index.php?route=admin.users&success=validate');
        }
    }

    /**
     * delete user
     */
    public function delete()
    {
        $this->isAdmin();

        $this->users->delete($_POST['id']);
        header('Location: index.php?route=admin.users&success=delete');
    }
}