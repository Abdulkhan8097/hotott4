<?php $session = session(); ?>
<?php if($session->get('isUserLoggedIn')){ ?>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                © <script>document.write(new Date().getFullYear())</script> Veltrix<span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Genie Soft System PVT LTD</span>
            </div>
        </div>
    </div>
</footer>
<?php } ?>