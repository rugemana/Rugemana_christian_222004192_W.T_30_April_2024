<?php include 'welcomeheader.php' ?>
      <div class="hero">
          <div class="bg-img">
              <img src="./images/r.jpeg" alt="">
          </div>
          <div class="words">
              <h1>Welcome to Digital Device Tracker Management System</h1>
              <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#loginModal" style="width:30%;"> login here</button>
          </div>
        <div class="overlay"></div>
      </div>
      <div class="about-section">
        <div class="section-tible">
        <h2>Our Services</h2>
        <p>
          Explore the range of services we offer to make  digital device tracker effectively managing digital assets, enhancing security, and improving operational efficiency.
        </p>
      </div>
      <div class="service-cards-container">
        <div class="services-card">
          <div class="card-icon-container">
            <!-- Icon for Mobile Device Management -->
            <i class="fa-solid fa-mobile icon"></i>
          </div>
          <div class="services-card-info">
            <h3>Mobile Device Management</h3>
            <p>
             Providing MDM solutions to centrally manage and secure mobile devices used within an organization, including device provisioning, application management, and security enforcement 
            </p>
          </div>
        </div>
        <div class="services-card">
          <div class="card-icon-container">
            <!-- Icon for GPS Tracking Solutions -->
            <i class="fa-brands fa-uikit icon"></i>
          </div>
          <div class="services-card-info">
            <h3>Gps Tracking Solutions</h3>
            <p>
              Providing GPS tracking services for various digital devices such as smartphones, tablets, laptops, and vehicles, This allows businesses to monitor the real-time location of their assets and personnel
            </p>
          </div>
        </div>
        <div class="services-card">
          <div class="card-icon-container">
            <!-- Icon for Advertisement -->
            <i class="fa-solid fa-mobile icon"></i>
          </div>
          <div class="services-card-info">
            <h3>Device Monitoring and Alerts</h3>
            <p>
              Developing monitoring systems that track device usage patterns, performance metrics, and security events, and provide alerts for anomalies or potential issues
            </p>
          </div>
        </div>
      </div>
    </div>
 
  
     

  
    
    
        <div class="about-section" id="contact">
        <div class="section-tible">
          <h2>Contact us</h2>
          <p>
            for more information you can search for us on the following addresses!
          </p>
        
        <form action="submit_form.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
           
<div class="input-group-element">
                <textarea
                  id="message"
                  cols="20"
                  rows="10"
                  placeholder="Message"
                ></textarea>
                <div class="error"></div>
              </div>
              <div
                style="
                  display: flex;
                  align-items: center;
                  justify-content: center;
                
              "
              >
                <button class="btn" type="submit">Send Message</button>
              </div>
        </form>
           
              
               
    <div class="about-section">
      <div class="section-tible">
        <h2>ABOUT US</h2>
        <p>
        Here we are looking to provide digital device tracking management services to our users,  

        </p>
<div class="about-info">
            <div class="person-details">
              <div>
                <p><b>First Name:</b><span> Rugemana</span></p>
              </div>
              <div>
                <p><b>Last Name:</b> <span>Christian</span></p>
              </div>
              <div>
                <p><b>Email:</b> <span>chris@gmail.com</span></p>
              </div>
              <div>
                <p><b>Tel: </b><span>+250 787116247</span></p>
              </div>
            </div>
            <div class="person-media">
              <div><i class="fa-brands fa-facebook"></i> Facebook</div>
              <div><i class="fa-brands fa-instagram"> </i> Instagram</div>
              <div><i class="fa-brands fa-twitter"></i> Twitter</div>
              <div><i class="fa-brands fa-whatsapp"></i> Whatsapp</div>
              <div><i class="fa-brands fa-skype"></i> skype</div>
<div><i class="fa-brands fa-youtube"></i> youtube</div>

         
              
            
            </div>
          </div>
        </div>

        <div class="right">
          <div class="img-about">
            <img src="./images/image2.JPG" alt="" />
            <img src="./images/image1.jpg" alt="" />
          </div>
      </div>


     Welcome to our digital device tracking, your trusted solution for digital device tracking management

At our digital device tracker, we understand the importance of staying connected with your digital devices, whether it's your smartphone, tablet, laptop, or any other valuable gadget, Our platform empowers users to efficiently track and manage their devices with ease and peace of mind,With a focus on simplicity, security, and reliability, digital tracking offers a comprehensive suite of features designed to meet the diverse needs of our users.
         
        </div>
      </div>
    </div>
  </body>
</html>

            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include 'modal.php' ?>
<?php include 'footer.php' ?>

