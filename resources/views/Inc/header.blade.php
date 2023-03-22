<header>
  <div class="container-fluid border-bottom">
    <div class="container">
      <div class="d-flex justify-content-between border-bottom py-1 align-items-center">
        <div class="col-md-4 col-sm-6">
          <div class="d-flex justify-content-end">
            @yield('cms-toggle')
            <div class="px-4">
              <a  class="btn text-muted no-decor" href="#">Stories</a>
            </div>
            <div class="dropdown show ">
              <a class="btn text-muted btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Policy
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>

        </div>
        <div class="dropdown">
          <a class="btn text-muted btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle px-3" src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('Images/user-img1.png') }}" alt="Profile" style="height:54px">
            <span id="userAvatar">{{ isset($user) ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
              <a class="dropdown-item" href="#">Login as Admin</a>
              <a class="dropdown-item" href="{{ route('edit-profile', ['user_id' => Auth::user()->user_id]) }}">Edit Profile </a>

          </div>
        </div>
      </div>
    </div>
  </div>
</header>
