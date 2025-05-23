<!DOCTYPE html>
<html lang="bn">
  <head>

    {{-- Css Include --}}
    @include('landing_page.include.css')

  </head>
<body>

   {{-- Body Content Start --}}

      @yield('body-content')

   {{-- Body Content End --}}


   {{-- Footer Include --}}
   @include('landing_page.include.footer')
   

   {{-- Script Include --}}
   @include('landing_page.include.script')
   
</body>
</html>
