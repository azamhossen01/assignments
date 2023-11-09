@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<form action="{{ route('posts.update', $post->uuid) }}" method="POST">
  @csrf 
  @method('put')
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-xl font-semibold leading-7 text-gray-900">
        Edit Post
      </h2>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="col-span-full">
          
          <div class="mt-2">
            <textarea
              id="description"
              name="description"
              rows="3"
              class="description block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{ old('description', $post->description) }}</textarea
            >
            @error('description')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
          </div>
          <p class="mt-3 text-sm leading-6 text-gray-600">
            Update post.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    {{-- <button
      type="button"
      class="text-sm font-semibold leading-6 text-gray-900">
      Cancel
    </button> --}}
    <button
      type="submit"
      class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
      Update
    </button>
  </div>
</form>

@endsection 

@push('script')
<script src="https://cdn.tiny.cloud/1/8f2msjsadq6j3oxg3ailuiv1fnt7nt7u8pg05rmsrsaflm01/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
    selector: '.description',
    height: 500,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic underline strikethrough | ' +
        'alignleft aligncenter alignright alignjustify | ' +
        'outdent indent | numlist bullist | removeformat | code',
});

</script>
@endpush