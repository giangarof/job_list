    <?php if(isset($_SESSION['alert'])) : ?>
        <div class="p-4 bg-light">

            <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
                <strong> <?= $_SESSION['alert']['message'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
       
    
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>