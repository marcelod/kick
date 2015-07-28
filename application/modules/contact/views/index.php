<!-- Page Content -->
  <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Contact
                  <small>Subheading</small>
              </h1>
              <ol class="breadcrumb">
                  <li><a href="index.html">Home</a>
                  </li>
                  <li class="active">Contact</li>
              </ol>
          </div>
      </div>
      <!-- /.row -->

      <div class="row">
          <div class="col-lg-12">
            <?php echo $message;?>
          </div>
      </div>

      <!-- Content Row -->
      <div class="row">
          <!-- Map Column -->
          <div class="col-md-8">
              <!-- Embedded Google Map -->
              <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>          </div>
          <!-- Contact Details Column -->
          <div class="col-md-4">
              <h3>Contact Details</h3>
              <p>
                  3481 Melrose Place<br>Beverly Hills, CA 90210<br>
              </p>
              <p><i class="fa fa-phone"></i>
                  <abbr title="Phone">P</abbr>: (123) 456-7890</p>
              <p><i class="fa fa-envelope-o"></i>
                  <abbr title="Email">E</abbr>: <a href="mailto:name@example.com">name@example.com</a>
              </p>
              <p><i class="fa fa-clock-o"></i>
                  <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
              <ul class="list-unstyled list-inline list-social-icons">
                  <li>
                      <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                  </li>
              </ul>
          </div>
      </div>
      <!-- /.row -->

      <!-- Contact Form -->
      <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <div class="row">
          <div class="col-md-8">
              <h3>Send us a Message</h3>

              <?php echo form_open('contact/send'); ?>
                  <div class="control-group form-group">
                      <div class="controls">
                          <label>Full Name:</label>
                          <?php echo form_error('name'); ?>
                          <input type="text" class="form-control" id="name" name="name" required data-validation-require-dmessage="Please enter your name." value="<?php echo set_value('name') ;?>">
                      </div>
                  </div>
                  <div class="control-group form-group">
                      <div class="controls">
                          <label>Phone Number:</label>
                          <?php echo form_error('telephone'); ?>
                          <input type="tel" class="form-control" id="telephone" name="telephone" required data-validation-required-message="Please enter your phone number." value="<?php echo set_value('telephone') ;?>">
                      </div>
                  </div>
                  <div class="control-group form-group">
                      <div class="controls">
                          <label>Email Address:</label>
                          <?php echo form_error('email'); ?>
                          <input type="email" class="form-control" id="email" name="email" required data-validation-required-message="Please enter your email address." value="<?php echo set_value('email') ;?>">
                      </div>
                  </div>
                  <div class="control-group form-group">
                      <div class="controls">
                          <label>Message:</label>
                          <?php echo form_error('message'); ?>
                          <textarea rows="10" cols="100" class="form-control" id="message" name="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"><?php echo set_value('message') ;?></textarea>
                      </div>
                  </div>
                  <div id="success"></div>
                  <!-- For success/fail messages -->
                  <button type="submit" class="btn btn-primary">Send Message</button>
                  <button type="reset" class="btn btn-default">Clear</button>
              <?php echo form_close(); ?>
          </div>

      </div>
      <!-- /.row -->

      <hr>

  </div>
  <!-- /.container -->