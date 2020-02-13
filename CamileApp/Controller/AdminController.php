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
            $post = $this->token->check($_POST);

            $formMessage = $this->postsValidationForm->checkForm($post);

            if(!$formMessage)
            {
                $this->posts->add($post);
                header('Location: index.php?route=admin.posts&success=add');
                exit;
            }
            else
            {
                $postAddUnvalid = $post;
                $categories = $this->categories->all('categories', 'name');
                $this->render('addOrUpdatePost', compact('categories', 'formMessage', 'postAddUnvalid'));
            }
        }
        else
        {
            $categories = $this->categories->all('categories', 'name');
            $this->render('addOrUpdatePost', compact('categories'));
        }

    }

    /**
     * update post in admin dashboard
     */
    public function updatePost()
    {
        $this->isAdmin();

        if($_POST)
        {
            $post = $this->token->check($_POST);

            $formMessage = $this->postsValidationForm->checkForm($post);

            if(!$formMessage)
            {
                $this->posts->update($post);
                header('Location: index.php?route=admin.posts&success=update');
            }
            else
            {
                $postUpdateUnvalid = $post;
                $comments = $this->comments->commentsById($_GET['id']);
                $categories = $this->categories->all('categories', 'name');
                $this->render('addOrUpdatePost', compact('categories', 'comments', 'formMessage', 'postUpdateUnvalid'));
            }
        }
        else
        {
            $post = $this->posts->postById($_GET['id']);
            $comments = $this->comments->commentsById($_GET['id']);
            $categories = $this->categories->all('categories', 'name');
            $this->render('addOrUpdatePost', compact('post', 'categories', 'comments'));
        }
    }

    /**
     * delete post in admin dashboard
     */
    public function deletepost()
    {
        $this->isAdmin();
        $this->token->check($_GET);
        $this->delete('posts');
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
            $post = $this->token->check($_POST);

            $formMessage = $this->categoriesValidationForm->checkForm($post);

            if(!$formMessage)
            {
                $this->categories->add($post);
                header('Location: index.php?route=admin.categories&success=add');
                exit;
            }
            else
            {
                $postAddUnvalid = $post;
                $this->render('addOrUpdatecategory', compact('formMessage', 'postAddUnvalid'));
            }
        }
        else
        {
            $this->render('addOrUpdateCategory');
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
            $post = $this->token->check($_POST);

            $formMessage = $this->categoriesValidationForm->checkForm($post);

            if(!$formMessage)
            {
                $post['id'] = $_GET['id'];
                $this->categories->update($post);
                header('Location: index.php?route=admin.categories&success=update');
                exit;
            }
            else
            {
                $id = $_GET['id'];
                $postUpdateUnvalid = $post;
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
     * delete category in admin dashboard
     */
    public function deleteCategory()
    {
        if($_GET['id'] != 1)
        {
            $this->isAdmin();
            $this->token->check($_GET);
            $this->delete('categories');
        }
        else
        {
            header('Location: index.php?route=admin.categories&success=no');
            exit;
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
        $this->token->check($_GET);

        $this->comments->validate($_GET['commentId']);
        header('Location: index.php?route=admin.comments&id=' . $_GET['id'] . '&action=validate#comments');
        exit;
    }

    /**
     * modify comment
     */
    public function updateComment()
    {
        $this->isAdmin();
        $post = $this->token->check($_POST);

        $this->comments->update($_GET['commentId'], $post['content']);
        header('Location: index.php?route=admin.comments&id=' . $_GET['id'] . '&action=update#comments');
        exit;
    }

    /**
     * delete a comment
     */
    public function deleteComment()
    {
        $this->isAdmin();
        $this->token->check($_GET);

        $this->comments->delete($_GET['commentId']);
        header('Location: index.php?route=admin.comments&id=' . $_GET['id'] . '&action=delete#comments');
        exit;
    }

    /**
     * Admin users dashboard
     */
    public function users()
    {
        $this->isAdmin();

        $display = 'all';
        $users = $this->users->all('users', 'pseudo');
        $this->displayUserAdmin($display, $users);
    }

    /**
     * add user
     */
    public function addUser()
    {
        $this->isAdmin();

        if($_POST)
        {
            $post = $this->token->check($_POST);

            // Form verification
            $formMessage = $this->pseudoOrEmailExist() ? $this->pseudoOrEmailExist() : $formMessage = $this->usersValidationForm->checkForm($post);

            if($formMessage)  // form ok
            {
                $statuts = $this->users->statut();
                $this->render('addOrUpdateUser', compact('statuts', 'formMessage', 'post'));
            }
            else // form not ok
            {
                $post['validated'] = 1;
                $this->users->add($post);
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
            $postUpdate = $this->token->check($_POST);
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
                $this->users->update(['id' => $_GET['id'], 'pseudo' => $_POST['pseudo'], 'email' => $_POST['email'], 'statut' => $_POST['statut']]);
                header('Location: index.php?route=admin.users&success=update');
                exit;
            }
        }
    }

    /**
     * delete user
     */
    public function deleteUser()
    {
        $this->token->check($_GET);
        $this->isAdmin();
        $this->delete('users');
    }

    /**
     * One postById (by id) comment allow
     */
    public function postById()
    {
        $this->isAdmin();
        $this->viewPostById();
    }

    /**
     * validate ($get = unvalide, $action = validate) or unlock ($get = unactive, $action = activate) user
     */
    public function validateUsers()
    {
        $this->isAdmin();

        if(!isset($_GET['id']))
        {
            $users = $this->users->getUnvalide();
            $this->displayUserAdmin('validate', $users);
        }
        else
        {
            $this->token->check($_GET);
            $user = $this->users->infoPseudoWithId($_GET['id']);
            $this->users->validate(['id' => $_GET['id']]);
            $this->mail->send($this->mail->validate($user));

            header('Location: index.php?route=admin.users&success=validate');
        }
    }

    /**
     * validate ($get = unvalide, $action = validate) or unlock ($get = unactive, $action = activate) user
     */
    public function unlockUsers()
    {
        $this->isAdmin();

        if(!isset($_GET['id']))
        {
            $users = $this->users->getlocked();
            $this->displayUserAdmin('validate', $users);
        }
        else
        {
            $this->token->check($_GET);
            $user = $this->users->infoPseudoWithId($_GET['id']);
            $this->unlock($user);
            header('Location: index.php?route=admin.users&success=unlock');
        }
    }

}

