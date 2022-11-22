<?php

setcookie(
  "userToken",
  "",
  time() - 1,
  "/"
);

header("location: http://walletyours.infinityfreeapp.com/");
