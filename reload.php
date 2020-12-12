<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      .loader {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
       width: 120px;
      height: 120px;
       animation: spin 2s linear infinite;
     }

  @keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
  }
    </style>
    <script type="text/javascript">
        setTimeout(() => {  <?php header( "refresh:4;start_page.html" ); ?>}, 2000);
    </script>

  </head>
  <body>

    <h1>ATTENDANCE ENTRIES ARE UPDATED .PLEASE WAIT ..</h1>
    <center><div class="loader">

    </div></center>
  </body>
</html>
