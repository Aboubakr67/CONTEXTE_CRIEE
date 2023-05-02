<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
<link rel="stylesheet" href="<?php echo base_url().'css\stylePageConnexion.css';?>">
</head>
<?php
    echo "<br>";
    echo form_open('welcome/connexion',array('method'=>'post'));
?>

<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    LOGIN
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form>

                          <div class="form-group">
                                <label class="form-control-label">ROLE</label>
                                <select name="role" class="form-select">
                                  <option value="Acheteur" selected>Acheteur</option>
                                  <option value="Admin">Admin</option>
                                  <option value="Directeur">Directeur de vente</option>   
                                </select>
                            </div>


                        
                            <div class="form-group">
                                <label class="form-control-label">EMAIL</label>
                                <input type="text" name="mail" id="mail" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="mdp" id="mdp" class="form-control" required>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-12 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>


	<?php
    if($this->session->flashdata('error')) { ?> 
    <p class="text-danger text-center" style="margin-top: 10px;color: red;">
    <?=$this->session->flashdata('error')?></p>
    <?php }
    
    echo form_close();
    echo "</center>";
?>
<script src="<?php echo base_url().'script/script.js';?>"> 
</script>
</html>