<div class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
      <div class='container-fluid'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='#' style='color:gold;'>Welcome <span class='text-capitalize'><?php echo strtolower($_SESSION["user"]->name()); ?></span> </a>
        </div>
        <div class='navbar-collapse collapse'>
          <ul class='nav navbar-nav navbar-right' style='color:gold;'>
            <li><a href='#'>Dashboard</a></li>
            <li> <a href='#'>Settings</a></li>
            <li><a href='#'>Profile</a></li>
            <li><a href='/resource.php?rq=logout'>logout</a></li>
          </ul>
          <form class='navbar-form navbar-right'>
            <input type='text' class='form-control' placeholder='Search...'>
          </form>
        </div>
      </div>
    </div>

