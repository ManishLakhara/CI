<header>
  <div class="container-fluid border-bottom">
    <div class="container-fluid w-100 ">
      <div class="d-flex justify-content-between border-bottom py-1 align-items-center">
        <div class="col-md-4 col-sm-6">
          <div class="d-flex justify-content-end">
            @yield('cms-toggle')
            <div class="px-4">
                <a  class="btn text-muted no-decor" href="{{ route('landing.index') }}">Home</a>
              </div>
            <div class="px-4">
              <a  class="btn text-muted no-decor" href="{{ route('mystories.index') }}">Stories</a>
            </div>
            <div class="dropdown show ">
              <a class="btn text-muted btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Policy
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="max-height: 15em;width: 30em;">

                @foreach ($policies as $policy)
                <li class="nav-item">
                   
                        <a href="{{ url('cms') . '#' . $policy->slug}}" style="cursor: pointer;text-decoration:none;">

                        <div class="d-flex justify-content-between">
                            <span class="nav-link text-dark">{{ $policy->title }}</span>

                        </div>
                    </a>

                    <hr>
                </li>
            @endforeach
              </div>
            </div>
          </div>

        </div>

        <div class="dropdown">
          <a class="btn text-muted btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle px-3" id="header-avatar"

            src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('Images/user-img1.png') }}"

            alt="Profile" style="height:54px">
            <span id="userAvatar">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
              <a class="dropdown-item" href="{{ route('timesheet.index') }}">Volunteering Timesheet</a>
              <a class="dropdown-item" href="{{ route('edit-profile', ['user_id' => Auth::user()->user_id]) }}">Edit Profile </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
