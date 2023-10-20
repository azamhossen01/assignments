@php
if(file_exists(storage_path('/data/profile.json'))){
    $profile = File::json(storage_path('/data/profile.json'));
}

@endphp
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
        <h1>{{ $profile['name'] }}</h1>
        <p>I'm <span class="typed" data-typed-items="{{ implode(',', $profile['designations']) }}"></span></p>
        {{-- <p>I'm <span class="typed" data-typed-items="Designer, Developer, Freelancer, Photographer"></span></p> --}}
    </div>
</section>
