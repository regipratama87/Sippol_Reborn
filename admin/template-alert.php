<?php if(isset($_SESSION['error_message_admin'])): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
    <b>Error!</b> <?php echo $_SESSION['error_message_admin']; ?>
    </div>
    <?php unset($_SESSION['error_message_admin']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['success_message_admin'])): ?>
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
        <b>Berhasil!</b> <?php echo $_SESSION['success_message_admin']; ?>
    </div>
    <?php unset($_SESSION['success_message_admin']); ?>
<?php endif; ?>