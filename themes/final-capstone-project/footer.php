<footer>
    <!-- Aquí puedes colocar información del pie de página -->
    <p>&copy; <?php echo date('Y'); ?> Mi Sitio Web</p>
</footer>
<?php 
// if dist folder not exist add the script
error_log(!get_template_directory() . '/dist/.vite/manifest.json');
if (!file_exists(get_template_directory() . '/dist/.vite/manifest.json')) {
    ?>
      
        <script type="module">
            import RefreshRuntime from "http://localhost:3334/@react-refresh"
            RefreshRuntime.injectIntoGlobalHook(window)
            window.$RefreshReg$ = () => {}
            window.$RefreshSig$ = () => (type) => type
            window.__vite_plugin_react_preamble_installed__ = true
        </script>
        <script type="module" src="http://localhost:3334/@vite/client"></script>
        </script>
    <?php
} 

?>
<?php wp_footer(); ?>
</body>
</html>
