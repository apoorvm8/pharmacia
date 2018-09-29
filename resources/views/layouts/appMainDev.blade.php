<html>

<head>
  <!--Import Google Icon Font-->
  {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
  {{-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> --}}
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="{{asset('assets/mainWebsite/css/materialize.min.css')}}" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="{{asset('assets/mainWebsite/css/main.css')}}" />
  {{-- <link href="https://fonts.google.com/specimen/Noto+Sans?selection.family=Noto+Sans" rel="stylesheet"> --}}
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,400italic" as="style" onload="this.onload=null;this.rel='stylesheet'"> --}}
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pharmacia</title>
</head>

<body id="home" class="scrollspy">
  <!-- Fixed navbar, therefore the repsonsive side-navs link comes under the div -->
  

{{-- ###END of FIXED NAV --}}
  @yield('content')
  
 
  <!-- Footer -->
  
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="{{asset('assets/mainWebsite/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/mainWebsite/js/materialize.min.js')}}"></script>
  <script>
    $(document).ready(function () {
      // Custom JS & jQuery here

      // Init side-navigation for repsonsive 
      $('.button-collapse').sideNav();

      // Init slider 
      $('.slider').slider({
        indicators: false,
        height: 500,
        transition: 500,
        interval: 6000
      });

      // Autocomplete
      $('.autocomplete').autocomplete({
        data: {
          "Crocin 250mg": null,
          "Crocin 500mg": null,
          "Iodex": null,
          "Vicks": null,
          "Medicine": null,
          "Hello": null,
          "World": null,
        }
      });

      // Init scrollspy
      $('.scrollspy').scrollSpy();

      // Scroll Fire
      const options = [
        {
          selector: '.banner-text', offset: 0, callback: function(el) {
            Materialize.fadeInImage($(el));
          }
        },

        // {
        //   selector: '.navbar-fixed', offset: 1300, callback: function() {
        //     $('nav').removeClass('transparent').addClass('blue');
        //     $('.banner-links a').removeClass('black-text').addClass('white-text');
        //   }
        // }
      ]

      Materialize.scrollFire(options);
    });

  </script>
</body>

</html>