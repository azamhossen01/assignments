@php
$data = File::json(storage_path('/data/resume.json'))['profile'];
@endphp
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
        <h1>{{ $data['name'] }}</h1>
        <p>I'm <span class="typed" data-typed-items="{{ implode(',', $data['designations']) }}"></span></p>
        {{-- <p>I'm <span class="typed" data-typed-items="Designer, Developer, Freelancer, Photographer"></span></p> --}}
    </div>
</section>
