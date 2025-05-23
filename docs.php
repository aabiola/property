<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cohort 28 Class Project to learn API and webservices">
    <meta name="author" content="Cohort 28 Class Project"> 
    <title>Search through apartments</title>
 

<link href="assets/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

     

      
    </style>

    
  </head>
  <body>
<div class="container">
  <div class="row">
    
<div class="col-lg-12 p-4">
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
       <img src="assets/static/images/dev.jpg" class="logo" width="40">
      <span class="fs-4">My Property App</span>
    </a>
  </header>

  <main>
    <h1 class="text-body-emphasis">Property Listings you can trust</h1>
    <p class="fs-5 col-md-8">Find and book short stay apartments.
Search through 13,274 properties around your favourite destinations
</p>

    <div class="mb-5">
      <a href="index.php" class="btn btn-primary btn-lg px-4">Merchant Signup</a>
    </div>

    <hr class="col-3 col-md-2 mb-5">

    <div class="row g-5">
     
      <div class="col-md-7">
        <h2 class="text-body-emphasis">Get Started</h2>
        <p>Here is a sample documentation for the create endpoint.</p>
        <code>
          <p> method: POST <br>
base url: http://localhost/property/api/ <br>

endpoint: v1/create.php  <br>

<u>Request PayLoad</u> <br>
 

{ <br>
  "name":"Oriental",<br>
  "price":"60000",<br>
  "category":"1",<br>
  "contact":"Seyi Tinubu",<br>
  "filename":"https://localhost/property/assets/uploads/orient-front.jpg"<br>
}<br>

<u>Response PayLoad</u><br>

{<br>
  "status":"failed|success",<br>
  "message":"Record sucessfully added",<br>
  "data":[]<br>
}<br>
</p>
</code>
      </div>

<div class="col-md-5 pt-5">
  <img src="assets/static/images/4291099.jpg" class="img-fluid">
</div>




    </div>
  </main>
  <footer class="pt-5 my-5 text-body-secondary border-top">
    Demo Website &middot; &copy; Remote Bootcamp
  </footer>
</div>

  </div>
</div> 

<script src="assets/static/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
