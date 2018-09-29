@extends('layouts.appMainDev')


@section('content')
@include('inc.main.headerDev')

 {{-- Section-> About --}}
 <section class="section scrollspy  grey lighten-4 center" id="about">
    <div class="container">
        <div class="row">
            <div class="col s12">
                  <h3>About</h3>
                  <p style="line-height: 1.8em;">Pharmacia are one of the largest pharmacy aggregators in India. We help patients connect with local pharmacy stores and diagnostic centres in order to fulfil their extensive medical needs. We believe that everyone should have access to good health. Thus, through our services we ensure you get access to the best and most genuine health products, with the highest savings in the shortest time possible. </p>
            </div>
        </div>
    </div>
</section>

<section class="section section-icons grey lighten-4 center">
  <div class="container">
    <div class="row">
      <div class="col s12 m4">
        <div class="card-panel">
          <img src="{{asset('assets/mainWebsite/images/order0.png')}}">
          <h5>Order Medicines</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, quia?</p>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card-panel">
          <img src="{{asset('assets/mainWebsite/images/diagnose0.png')}}" height="110">
          <h5>Diagnostic Tests</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, quia?</p>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card-panel">
          <img src="{{asset('assets/mainWebsite/images/healthcare0.png')}}" height="110">
          <h5>Health Care Products</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, quia?</p>
        </div>
      </div>
    </div>
</section>

<!-- Section: Popular -->
<section id="article" class="scrollspy section section-popular">
  <div class="container">
    <div class="row">
      <h4 class="center">
        <span class="red-text">Latest</span> Articles
      </h4>
      <div class="col s12 m4">
        <div class="card">
          <div class="card-image">
            <img src="{{asset('assets/mainWebsite/images/articleOne.jpg')}}" alt="">
          </div>
          <div class="card-content">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. A et atque tempore? Voluptatem, fugiat rem!
          </div>
          <div class="card-action">
              <a href="#" class="btn red lighten-1 waves-effect waves-light">View More</a>
          </div>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card">
          <div class="card-image">
            <img src="{{asset('assets/mainWebsite/images/articleTwo.jpg')}}" alt="">
          </div>
          <div class="card-content">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. A et atque tempore? Voluptatem, fugiat rem!
          </div>
          <div class="card-action">
              <a href="#" class="btn red lighten-1 waves-effect waves-light">View More</a>
          </div>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card">
          <div class="card-image">
            <img src="{{asset('assets/mainWebsite/images/articleThree.jpg')}}" alt="">
          </div>
          <div class="card-content">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. A et atque tempore? Voluptatem, fugiat rem!
          </div>
          <div class="card-action">
              <a href="#" class="btn red lighten-1 waves-effect waves-light">View More</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12 center">
        <a href="#contact" class="btn btn-large grey darken-3">
          <i class="material-icons left">send</i> Contact For Booking
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Section: Follow -->
<section class="section section-follow transparent black-text center">
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h4>Follow Pharmacia</h4>
        <p>Follow us on social media for special offers</p>
        <a href="#" target="_blank" style="padding: 0% 1%;">
          <i class="black-text fab fa-facebook fa-2x"></i>
        </a>
        <a href="#" target="_blank"  style="padding: 0% 1%;">
          <i class="black-text fab fa-twitter fa-2x"></i>
        </a>
        <a href="#" target="_blank"  style="padding: 0% 1%;">
          <i class="black-text fab fa-linkedin fa-2x"></i>
        </a>
        <a href="#" target="_blank"  style="padding: 0% 1%;">
          <i class="black-text fab fa-google-plus fa-2x"></i>
        </a>
        <a href="#" target="_blank"  style="padding: 0% 1%;">
          <i class="black-text fab fa-pinterest fa-2x"></i>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- Section: Contact -->
<section id="contact" class="scrollspy section section-content">
  <div class="container">
    <div class="row">
      <div class="col s12 m6">
        <div class="card-panel blue white-text center">
          <i class="material-icons medium">email</i>
          <h5>Contact Us For Booking</h5>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi, nisi? Dolore nihil saepe impedit vero sit, totam
            optio vita repudiandae.</p>
        </div>
        <ul class="collection with-header">
          <li class="collection-header">
            <h4>Location</h4>
          </li>
          <li class="collection-item">Kolkata</li>
          <li class="collection-item">West Bengal</li>
        </ul>
      </div>
      <div class="col s12 m6">
        <div class="card-panel grey lighten-3">
          <h5>Please fill out this form</h5>
          <div class="input-field">
            <input type="text" placeholder="Name" id="name">
            <label for="name">Name</label>
          </div>
          <div class="input-field">
            <input type="email" placeholder="Email" id="email">
            <label for="email">Email</label>
          </div>
          <div class="input-field">
            <input type="text" placeholder="Phone" id="phone">
            <label for="phone">Phone</label>
          </div>
          <div class="input-field">
            <textarea id="message" class="materialize-textarea" placeholder="Enter Message"></textarea>
            <label for="message">Message</label>
          </div>
          <input type="submit" value="Submit" class="btn red lighten-1">
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="section blue  white-text center">
    <p class="flow-text">Pharmacia &copy; 2018</p>
</footer>
@endsection