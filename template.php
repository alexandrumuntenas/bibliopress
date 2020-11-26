<?php require 'bp-config.php';
?>
<html>
<title>
    <?php echo 'Biblioteca del ' . $sname; ?>
</title>
<?php require 'bp-include/head.php'; ?>

<body>
    <?php require 'bp-include/menu.php'; ?>
    <div>
        <header>
            <div class="bp-header">
                <h2 class="bp-page-title">Catálogo</h2>
            </div>
        </header>
        <section class="bp-section">
            <div>
                
            </div>
        </section>
    </div>
    </div>
    <footer class="page-footer bg-primary">
        <div class="footer-copyright text-center py-3 fwhite"><?php echo "© " . date("Y") . " " . $sname; ?> | Powered by Bibliopress</a>
        </div>
    </footer>
</body>

</html>