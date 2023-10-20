<header id="header">
    <div class="d-flex flex-column">
    @php
        if(file_exists(storage_path('/data/profile.json'))){
          $profile = File::json(storage_path('/data/profile.json'));
        }
        if(file_exists(storage_path('/data/theme.json'))){
          $data = File::json(storage_path('/data/theme.json'));
        }
        
        // $data = File::json(storage_path('/data/resume.json'));
    @endphp
      <div class="profile">
        <img src="{{ $profile['avatar'] }}" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="{{ route('home') }}">{{ $profile['name'] }}</a></h1>
        <div class="social-links mt-3 text-center">
          @forelse ($data['socials'] as $item)
              <a target="_blank" href="{{ $item['link'] }}" class="{{ $item['class'] }}"><i class="{{ $item['icon'] }}"></i></a>
          @empty
              
          @endforelse
          
          {{-- <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
        </div>
      </div>

      <nav class="nav-menu">
        <ul>

            @forelse ($data['menus'] as $menu)
                <li class="{{ Route::currentRouteName() === $menu['url'] ? 'active' : '' }}"><a href="{{ route($menu['url']) }}"><i class="{{ $menu['icon'] }}"></i> <span>{{ $menu['title'] }}</span></a></li>
            @empty
                
            @endforelse

          {{-- <li class="active"><a href="{{ route('home') }}"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="#resume"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
          <li><a href="#portfolio"><i class="bx bx-book-content"></i> Portfolio</a></li>
          <li><a href="#services"><i class="bx bx-server"></i> Services</a></li>
          <li><a href="#services"><i class="bx bx-envelope"></i> Services</a></li> --}}
          
          

        </ul>
      </nav><!-- .nav-menu -->
      
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
  </header><!-- End Header -->