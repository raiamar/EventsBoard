<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
@include('backend.inc.head')
@include('layouts.toast-message')
@include('sweetalert::alert')

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        {{-- where is this --}}
        @include('backend.inc.sidebar')

        <div class="flex flex-col flex-1 w-full">
            {{-- @include('backend.inc.sidebar') --}}

            @include('backend.inc.nav')

            @yield('body')

            {{-- flowbite --}}
            <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
        </div>
    </div>


    @yield('script')

    @include('layouts.common-css')


    <script>
        $('#summernote').summernote({
            tabsize: 2,
            width: 920,
            height: 420,
            backcolor: 'white',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            styleTags: [
                'p',
                {
                    title: 'Blockquote',
                    tag: 'blockquote',
                    className: 'blockquote',
                    value: 'blockquote'
                },
                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ]

        });
    </script>


    <script>
        $(document).ready(function() {
            $('.multi-select').select2();
        });
    </script>

</body>

</html>
