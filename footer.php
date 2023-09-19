<!-- Footer ================================================== -->
<div id="footer">
    <!-- Footer Copyrights -->
    <div class="footer-bottom-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    © 2023 <strong>GCU FYP</strong>. All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copyrights / End -->
</div>
<!-- Scripts
================================================== -->
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/jquery-migrate-3.1.0.min.js"></script>
<script src="/js/mmenu.min.js"></script>
<script src="/js/tippy.all.min.js"></script>
<script src="/js/simplebar.min.js"></script>
<script src="/js/bootstrap-slider.min.js"></script>
<script src="/js/bootstrap-select.min.js"></script>
<script src="/js/snackbar.js"></script>
<script src="/js/clipboard.min.js"></script>
<script src="/js/counterup.min.js"></script>
<script src="/js/magnific-popup.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/custom.js"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function () {
Snackbar.show({
    text: 'Your status has been changed!',
    pos: 'bottom-center',
    showAction: false,
    actionText: "Dismiss",
    duration: 3000,
    textColor: '#fff',
    backgroundColor: '#383838'
});
}); 
</script>

<!-- Leaflet // Docs: https://leafletjs.com/ -->
<script src="/js/leaflet.min.js"></script>

<!-- Leaflet Geocoder + Search Autocomplete // Docs: https://github.com/perliedman/leaflet-control-geocoder -->
<script src="/js/leaflet-autocomplete.js"></script>
<script src="/js/leaflet-control-geocoder.js"></script>

</body>

</html>