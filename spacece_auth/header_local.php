<?php
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = null;
$module_name = null;

$extra_styles = '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
 integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.12.0/bootstrap-social.min.css">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.min.css" integrity="sha512-jpey1PaBfFBeEAsKxmkM1Yh7fkH09t/XDVjAgYGrq1s2L9qPD/kKdXC/2I6t2Va8xdd9SanwPYHIAnyBRdPmig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/css/bootstrap-multiselect.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
  .fa {
    padding: 5px;
    font-size: 30px;
    width: 58px;
    text-align: center;
    text-decoration: none;
    margin: 5px 2px;
    border-radius: 50%;
  }

  .fa-facebook {
    background: #3B5998;
    color: white;
  }

  .fa-google {
    background: #dd4b39;
    color: white;
  }
  .aweCheckbox {
    padding-left: 20px;
  }
  .aweCheckbox label {
    display: inline-block;
    vertical-align: middle;
    position: relative;
    padding: 0 20px 0 10px;
    cursor: pointer;
  }
  .aweCheckbox label::before {
    content: "";
    display: inline-block;
    position: absolute;
    width: 17px;
    height: 17px;
    left: 0;
    margin-left: -20px;
    border: 1px solid #cccccc;
    border-radius: 3px;
    background-color: #fff;
    -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
    -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
    transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
  }
  .aweCheckbox label::after {
    display: inline-block;
    position: absolute;
    width: 16px;
    height: 16px;
    left: 0;
    top: 0;
    margin-left: -20px;
    padding-left: 3px;
    padding-top: 1px;
    font-size: 11px;
    color: #555555;
  }
  .aweCheckbox input[type="checkbox"] {
    opacity: 0;
    z-index: 1;
  }
  .aweCheckbox input[type="checkbox"]:focus + label::before {
    outline: thin dotted;
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
  }
  .aweCheckbox input[type="checkbox"]:checked + label::after {
    font-family: "FontAwesome";
    content: "\f00c";
  }
  .aweCheckbox input[type="checkbox"]:indeterminate + label::after {
    display: block;
    content: "";
    width: 10px;
    height: 3px;
    background-color: #555555;
    border-radius: 2px;
    margin-left: -16.5px;
    margin-top: 7px;
  }
  .aweCheckbox input[type="checkbox"]:disabled + label {
    opacity: 0.65;
  }
  .aweCheckbox input[type="checkbox"]:disabled + label::before {
    background-color: #eeeeee;
    cursor: not-allowed;
  }
  .aweCheckbox.aweCheckbox-circle label::before {
    border-radius: 50%;
  }
  .aweCheckbox.aweCheckbox-inline {
    margin-top: 0;
  }
  .aweCheckbox-danger input[type="checkbox"]:checked + label::before {
    background-color: #d9534f;
    border-color: #d9534f;
  }
  .aweCheckbox-danger input[type="checkbox"]:checked + label::after {
    color: #fff;
  }
  .aweCheckbox-danger input[type="checkbox"]:indeterminate + label::before {
    background-color: #d9534f;
    border-color: #d9534f;
  }
  .aweCheckbox-danger input[type="checkbox"]:indeterminate + label::after {
    background-color: #fff;
  }
  input[type="checkbox"].styled:checked + label:after {
    content: "\f00c";
  }
  input[type="checkbox"] .styled:checked + label::before {
    color: #fff;
  }
  input[type="checkbox"] .styled:checked + label::after {
    color: #fff;
  }
  
  .dropdown-toggle {
    background-color: transparent !important;
    border:1px solid grey !important; 
    color: #000 !important;
  }
  
</style>
';

$extra_scripts = '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src = https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js"
 integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script type="text/javascript" src="main.js"></script>
';
