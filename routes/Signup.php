<?hh

class Signup {

  public static function get(): :xhp {

    if(Session::isActive()) {
      $user = Session::getUser();
      if($user->isMember()) {
        header('Location: dashboard.php');
      } else {
        header('Location: apply.php');
      }
    }

    return
      <form method="post" action="/signup">
        <input type="text" name="uname" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="password2" placeholder="Confirm password" />
        <input type="email" name="email" placeholder="email" />
        <input type="text" name="fname" placeholder="First Name" />
        <input type="text" name="lname" placeholder="Last Name" />
        <button type="submit">Submit</button>
      </form>;
  }

  public static function post(): void {
    if($_POST['password'] != $_POST['password2']) {
      header('Location /signup');
    }
    $user = User::create(
      $_POST['uname'],
      $_POST['password'],
      $_POST['email'],
      $_POST['fname'],
      $_POST['lname']
    );
    if(!$user) {
      header('Location: /signup');
    }
    Session::create($user);
    header('Location: /apply');
  }
}