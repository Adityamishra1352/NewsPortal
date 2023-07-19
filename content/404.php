<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: 404</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
    <style>
        
body {
  background-image: url(images/1222332.png);
  background-repeat: no-repeat;
  background-size: cover;
}

.mainbox {
  background-color: inherit;
  margin: auto;
  height: 600px;
  width: 600px;
  position: relative;
}

  .err {
    color:black;
    font-family: 'Nunito Sans', sans-serif;
    font-size: 11rem;
    position:absolute;
    left: 63%;
    top: 8%;
  }

.far {
  position: absolute;
  font-size: 8.5rem;
  left: 84%;
  top: 15%;
  color: black;
}

 .err2 {
    color: black;
    font-family: 'Nunito Sans', sans-serif;
    font-size: 11rem;
    position:absolute;
    left: 110%;
    top: 8%;
  }

.msg {
    text-align: center;
    font-family: 'Nunito Sans', sans-serif;
    font-size: 1.6rem;
    position:absolute;
    left: 60%;
    top: 40%;
    width: 75%;
  }

a {
  text-decoration: none;
  color: brown;
  /* background-color: blueviolet; */
}

a:hover {
  text-decoration: underline;
}
.lamp {
  position: absolute;
  left: 0px;
  right: 600px;
  top: 0px;
  margin: 0px auto;
  width: 300px;
  display: flex;
  flex-direction: column;
  align-items: center;
  transform-origin: center top;
  animation-timing-function: cubic-bezier(0.6, 0, 0.38, 1);
  animation: move 5.1s infinite;
  overflow: none;
}

@keyframes move {
  0% {
    transform: rotate(30deg);
  }
  50% {
    transform: rotate(-30deg);
  }
  100% {
    transform: rotate(30deg);
  }
}

.cable {
  width: 8px;
    height: 20px;
    background-color:black;
}

.cover {
  width: 50px;
  height: 40px;
  background: black;
  border-top-left-radius: 50%;
  border-top-right-radius: 50%;
  position: relative;
  z-index: 200;
}

.in-cover {
  width: 100%;
  max-width: 200px;
  height: 10px;
  border-radius: 100%;
  background: black;
  position: absolute;
  left: 0px;
  right: 0px;
  margin: 0px auto;
  bottom: -9px;
  z-index: 100;
}
.in-cover .bulb {
     width: 50px;
    height: 50px;
    background-color: black;
    border-radius: 50%;
    position: absolute;
    left: 0px;
    right: 0px;
    bottom: -20px;
    margin: 0px auto;
    -webkit-box-shadow: 0 0 15px 7px rgba(0,0,0,0.8), 0 0 40px 25px rgba(0,0,0,0.5), -75px 0 30px 15px rgba(0,0,0,0.2);
    box-shadow: 0 0 25px 7px rgb(0 0 0 / 80%), 0 0 64px 47px rgba(0,0,0,0.5), 0px 0 30px 15px rgba(0,0,0,0.2);
}


.light {
      width: 200px;
    height: 0px;
    border-bottom: 530px solid black;
    opacity: 20%;
    border-left: 50px solid transparent;
    border-right: 50px solid transparent;
    position: absolute;
    left: 0px;
    right: 0px;
    top: 70px;
    margin: 0px auto;
    z-index: 1;
    border-radius: 90px 90px 0px 0px;
}
    </style>
  </head>
  <body>
    <div class="lamp__wrap">
      <div class="lamp">
        <div class="cable"></div>
        <div class="cover"></div>
        <div class="in-cover">
          <div class="bulb"></div>
        </div>
        <div class="light"></div>
      </div>
    </div>
    <div class="mainbox">
      <div class="err">4</div>
      <i class="far fa-question-circle fa-spin"></i>
      <div class="err2">4</div>
      <div class="msg">Maybe this page moved? Got deleted? Is hiding out in quarantine? Never existed in the first place?<p>Let's go <a href="/NewsPortal/index.php">Home</a> and try from there.</p></div>
    </div>
</body>
</html>