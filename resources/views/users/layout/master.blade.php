

@include('users.includes.css')

<body>

    <!--============================
               HEADER START
    ==============================-->
        @include('users.includes.header')



 <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">

    <!--=============================
         DASHBOARD SIDEBAR START
    ==============================-->
    @include('users.includes.sidebar')


        <!--=============================
               BODY CONTENT START
        ==============================-->
             @yield('body-content')
        <!--=============================
               BODY CONTENT END
        ==============================-->

    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->



    <!--============================
        SCROLL BUTTON & SCRIPT TAG
    ==============================-->
    @include('users.includes.script')


</body>

</html>