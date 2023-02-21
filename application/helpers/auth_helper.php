<?php

  function permission()
  {
    $ci = get_instance();
    $logged_user = $ci->session->userdata("logged_user");
    // se o usuario não estiver logado
    if (!$logged_user) {
      $ci->session->set_flashdata("danger", "Não foi possível acessar essa página.");
      redirect("login");
    } else {
      return $logged_user;
    }
  }