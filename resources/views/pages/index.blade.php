@extends('layouts.appMain')

@section('content') 
<style>
    .member-social1 p{
        font-size: 80%;
    }

</style>
<!-- banner-->
<div class="agile_banner">
    <div class="s1">
                <h3>MAKING</h3>
                <h4>YOUR LIFE EASY AND <span class="chng">HAPPY</span></h4>
                <p> The foundation of success in life is good health: that is the substratum fortune; it is also the basis of happiness</p>
                <div class="w3-button">
                    <div class="w3ls-button">
                        <a href="#about" class="scroll">Learn More</a>
                    </div>
                    <div class="w3l-button">
                        <a href="#departments" class="scroll">Portfolio</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
    
            </div>
    
    
    </div>
    <!--/banner-->
    
    <!-- About-->
    <div class="about" id="about">
    <div class="container">
    <h3>ABOUT US</h3>
    <div class="col-md-6 w3ls_al">
    <img src="{{asset('assets/mainWebsite/images/abt.jpg')}}" class="img-responsive" alt="">
    </div>
    <div class="col-md-6 w3ls_ar">
    <h4>The foundation of success in life is good health: that is the substratum fortune; it is also the basis of happiness</h4>
    <p>Pharmacia are one of the largest pharmacy aggregators in India. We help patients connect with local pharmacy stores and diagnostic centres in order to fulfil their extensive medical needs. We believe that everyone should have access to good health. Thus, through our services we ensure you get access to the best and most genuine health products, with the highest savings in the shortest time possible. </p>
    </div>
    <div class="clearfix"></div>
    
              <div class="row team-data">
              <h3>Latest Articles</h3>
                <div class="col-md-3 col-sm-3 col-xs-6 w3_src">
                  <div class="team-profile">
                    <div class="member-img" align="center">
                      <img src="{{asset('assets/mainWebsite/images/articleOne.jpg')}}" alt="">
                    </div>
                  
                    <div class="member-social1" align="center">
                      <p class="lead"><b>A Diabetic Diet: What Works with Dr. Naaznin Husein</b></p>
                      <p>Diabetes patients often struggle with the right diet. There are many fad diets that people follow but with no desirable results. However, with diabetes, ...</p>
                      <br>
                      <input class="btn btn-danger" type="button" name="button" value="Read More">
                    </div>
                </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 ">
                  <div class="team-profile">
                    <div class="member-img" align="center">
                      <img src="{{asset('assets/mainWebsite/images/articleTwo.jpg')}}" alt="">
                    </div>
                    
                    <div class="member-social1" align="center">
                        <p class="lead"><b>Vitamin A Deficiency Signs You Should Not Ignore!</b></p>
                        <p>Vitamin A deficiency signs are a common problem worldwide. Vitamin A is an essential fat-soluble vitamin that is needed by the body in adequate quantiti...</p>
                        <br>
                        <input class="btn btn-danger" type="button" name="button" value="Read More">
                    </div>
                  </div>
                </div>  <!-- member 1 ends here  -->
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="team-profile">
                 
                    <div class="member-img" align="center">
                      <img src="{{asset('assets/mainWebsite/images/articleThree.jpg')}}" alt="">
                    </div>
                    
                    <div class="member-social1" align="center">
                        <p class="lead"><b>10 Harmful Effects of Sugar</b></p>
                        <p>Too much sugar is bad for your health. It is an essential part of processed foods and is listed under many labels like agave nectar, corn syrup, sugar syrup,etc. it...</p>
                        <br><br>
                        <input class="btn btn-danger" type="button" name="button" value="Read More">
                    </div>
                  </div>
                </div> <!-- member 2 ends here  -->
                <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="team-profile">
                 
                    <div class="member-img" align="center">
                      <img src="{{asset('assets/mainWebsite/images/articleFour.jpg')}}" alt="">
                    </div>
                   
                    <div class="member-social1" align="center">
                      <p class="lead"><b>Heart Disease: 10 Surprising Causes of Damage</b></p>
                      <p>Heart disease is the leading cause of death all over the world. Without realizing it, there are many habits that we have that could be damaging your hea...</p>
                      <br>
                      <input class="btn btn-danger" type="button" name="button" value="Read More">
                      
                    </div>
                  </div>
                  
                  </div>
                  <div class="clearfix"></div>
                <!-- member 3 ends here  -->
              </div>
              
          
       </div>
    </div>
    <!-- /About-->
    
    <!-- services -->
        <div class="services" id="services">
            <div class="container">
                            <div class="wthree_head_section">
                    <h3 class="w3l_header w3_agileits_header two">OUR <span>SERVICES</span></h3>
                </div>
                <div class="agile_wthree_inner_grids">
                    <div class="col-md-4 col-sm-4 agileits_banner_bottom_left">
                        <div class="agileinfo_banner_bottom_pos">
                            <div class="w3_agileits_banner_bottom_pos_grid">
                                <div class="col-md-2 col-sm-2 wthree_banner_bottom_grid_left">
                                    <div class="agile_banner_bottom_grid_left_grid hvr-radial-out">
                                        <i class="fa fa-map-o" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 wthree_banner_bottom_grid_right">
                                    <h4 class="sub_service_agileits">CARDIOLOGY</h4>
                                    <p>The branch of medicine that deals with diseases and abnormalities of the heart.</p>
                                    
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 agileits_banner_bottom_left">
                        <div class="agileinfo_banner_bottom_pos1">
                            <div class="w3_agileits_banner_bottom_pos_grid">
                                <div class="col-md-2 col-sm-2 wthree_banner_bottom_grid_left">
                                    <div class="agile_banner_bottom_grid_left_grid hvr-radial-out">
                                        <i class="fa fa-rocket" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 wthree_banner_bottom_grid_right">
                                    <h4 class="sub_service_agileits">RADIOLOGY</h4>
                                    <p>Radiology is the science that uses medical imaging to diagnose and sometimes also treat.</p>
                                    
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 agileits_banner_bottom_left">
                        <div class="agileinfo_banner_bottom_pos2">
                            <div class="w3_agileits_banner_bottom_pos_grid">
                                <div class="col-md-2 col-sm-2 wthree_banner_bottom_grid_left">
                                    <div class="agile_banner_bottom_grid_left_grid hvr-radial-out">
                                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 wthree_banner_bottom_grid_right">
                                    <h4 class="sub_service_agileits">DENTAL</h4>
                                    <p>Dentistry is a branch of medicine that consists of the study, diagnosis, prevention.</p>
                                    
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 agileits_banner_bottom_left two">
                        <div class="agileinfo_banner_bottom_pos3">
                            <div class="w3_agileits_banner_bottom_pos_grid">
                                <div class="col-md-2 col-sm-2 wthree_banner_bottom_grid_left">
                                    <div class="agile_banner_bottom_grid_left_grid hvr-radial-out">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 wthree_banner_bottom_grid_right">
                                    <h4 class="sub_service_agileits">PEDIATRICS</h4>
                                    <p>Pediatrics is the branch of medicine that involves the medical care of infants.</p>
                                    
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 agileits_banner_bottom_left  two">
                        <div class="agileinfo_banner_bottom_pos4">
                            <div class="w3_agileits_banner_bottom_pos_grid">
                                <div class="col-md-2 col-sm-2 wthree_banner_bottom_grid_left">
                                    <div class="agile_banner_bottom_grid_left_grid hvr-radial-out">
                                        <i class="fa fa-fire" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 wthree_banner_bottom_grid_right">
                                    <h4 class="sub_service_agileits">DERMITOLOGY</h4>
                                    <p>Dermatology is the branch of medicine dealing with the skin, nails, hair.</p>
                                    
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 agileits_banner_bottom_left  two">
                        <div class="agileinfo_banner_bottom_pos5">
                            <div class="w3_agileits_banner_bottom_pos_grid">
                                <div class="col-md-2 col-sm-2 wthree_banner_bottom_grid_left">
                                    <div class="agile_banner_bottom_grid_left_grid hvr-radial-out">
                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 wthree_banner_bottom_grid_right">
                                    <h4 class="sub_service_agileits">NEUROLOGY</h4>
                                    <p>Neurology is a branch of medicine dealing with disorders.</p>
                                    
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- //services -->
        
    <!-- testimonals section -->
   
    <!-- /testimonals section -->
    
    
    <!-- Tabs-->
    
    <!--/Tabs-->
    
    <!-- Appointment Form -->
    <div class="appointmentform" id="appointmentform">
    <div class="container">
        <div class="register-full">
            <div class="register-right">
                <div class="register-in">
            
                    <h3>Enquiry FORM</h3>
                    <div class=" w3_abp">
                    <div class="registerimg">
                        <img src="{{asset('assets/mainWebsite/images/app.jpg')}}" class="img-responsive" alt="" />
                    </div>
                    </div>
                    <div class=" register-form">
                        <form action="{{route('email.submit')}}" method="post">
                            @csrf
                            <div class="fields-grid">
                                <div class="styled-input">
                                    <input type="text" name="name" required=""> 
                                    <label>Patients Name</label>
                                    <span></span>
                                </div> 
                                <div class="styled-input">
                                    <input type="email" name="email" required="">
                                    <label>Email</label>
                                    <span></span>
                                </div>
                                <div class="styled-input">
                                    <input type="text" name="mobileNo" required=""> 
                                    <label>Phone Number</label>
                                    <span></span>
                                </div> 
                                
                                <div class="styled-input">
                                    <label class="list">If yes,Please list it<span></span></label>
                                    <br><br>
									<textarea></textarea>
									<span></span>
								</div>
                                <input type="submit" name="submit" value="Book Appointment">
                                
                            </div>
                            
                        </form>
                            
                    </div>
                    <div class="clearfix"></div>
                 </div>
            </div>
            </div>
        </div>
        </div>
    
    <!-- //Appointment Form -->
    
    <!-- gallery -->
      
        
    <!-- //gallery -->
    
    
        <!-- footer -->
        <div class="contact" id="contact">
        <div class="container">
            <div class="f-bg-w3l">
            <h3>CONTACT US</h3>
                    <div class="col-md-4  w3layouts_footer_grid1">
                    <div class="form-bg-w3ls">
                        <h4 class="subhead-agileits white-w3ls">Get in Touch</h4>
                        <form action="">
                            <input type="text" name="Name" placeholder="Name" required="">
                            <input type="email" name="Email" placeholder="Email" required="">
                            <input type="text" name="Phone" required="" placeholder="Mobile No">
                            <div class="w3_cs">
                            <input type="button" value="SEND" class="button-w3layouts hvr-rectangle-out">
                            </div>
                        </form>
                    </div>	
                    </div>
                    <div class="col-md-4  w3layouts_footer_grid">
                        <iframe width="100%" height="320" src="https://maps.google.com/maps?width=100%&amp;height=320&amp;hl=en&amp;coord=28.4812633, 77.0485147&amp;q=New%20Delhi+(Pharmacia)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Add map to website</a></iframe><br />
                    </div>
                    <div class="col-md-4  w3layouts_footer_grid">
                        <h4>Address</h4>
                            <ul class="con_inner_text">
                                <li><span class="fa fa-map-marker" aria-hidden="true"></span><label> New Delhi</label></li>
                               
                            </ul>
    
                        <ul class="social_agileinfo">
                            <li><a href="#" class="w3_facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="w3_twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="w3_instagram"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#" class="w3_google"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
    
    
                    <div class="clearfix"> </div>
                        <p class="copyright">© 2018 Pharmacia. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
                </div>
                </div>
        </div>
        <!-- //footer -->
@endsection