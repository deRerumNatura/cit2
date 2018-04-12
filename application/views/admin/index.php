<section>
    <div class="weclome">
        <div class="container">
            <?php if(!empty($vars['login'])) :?>
                <h1>Welcome, <?php echo $vars['login'] ?></h1>
            <?php else: ?>
                <h1>Welcome, <?php echo $_SESSION['login'] ?></h1>
            <?php endif; ?>
        </div>
    </div>
</section>